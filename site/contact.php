<?php
/**
 * FALAÍ — Handler do formulário de contato
 *
 * Segurança aplicada:
 *  - Aceita apenas POST
 *  - Token CSRF validado com hash_equals()
 *  - Honeypot anti-bot
 *  - Validação e limite de tamanho de todos os campos
 *  - Whitelist para o campo "assunto"
 *  - PDO com prepared statements (sem SQL injection)
 *  - Rate limit por sessão e por IP (consulta ao banco)
 *  - E-mail montado sem dados crus em headers (sem header injection)
 *  - Respostas JSON sem vazar detalhes internos
 */

declare(strict_types=1);

require_once __DIR__ . '/lib/phpmailer/Exception.php';
require_once __DIR__ . '/lib/phpmailer/PHPMailer.php';
require_once __DIR__ . '/lib/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer as Mailer;
use PHPMailer\PHPMailer\Exception as MailerException;

session_start();
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

function respond(int $status, bool $ok, string $message): void
{
    http_response_code($status);
    echo json_encode(['ok' => $ok, 'message' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

// ---------- método ----------
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    respond(405, false, 'Método não permitido.');
}

// ---------- CSRF ----------
$token = (string)($_POST['csrf_token'] ?? '');
if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
    respond(403, false, 'Sessão expirada. Recarregue a página e tente novamente.');
}

// ---------- honeypot (bots preenchem, humanos não veem) ----------
if (!empty($_POST['site'])) {
    // responde sucesso falso para não dar pista ao bot
    respond(200, true, 'Mensagem enviada com sucesso!');
}

// ---------- rate limit por sessão ----------
$now = time();
$_SESSION['form_hits'] = array_values(array_filter(
    $_SESSION['form_hits'] ?? [],
    static fn($t) => ($now - $t) < 600
));
if (count($_SESSION['form_hits']) >= 3) {
    respond(429, false, 'Muitas tentativas. Aguarde alguns minutos e tente novamente.');
}

// ---------- validação ----------
$nome     = trim((string)($_POST['nome'] ?? ''));
$email    = trim((string)($_POST['email'] ?? ''));
$whatsapp = trim((string)($_POST['whatsapp'] ?? ''));
$assunto  = (string)($_POST['assunto'] ?? '');
$mensagem = trim((string)($_POST['mensagem'] ?? ''));

$assuntosValidos = [
    'duvida'   => 'Dúvidas',
    'pedido'   => 'Pedido',
    'parceria' => 'Parceria',
    'frase'    => 'Sugestão de frase',
    'outro'    => 'Outro',
];

$erros = [];

// nome: 2–100 chars, sem quebras de linha (evita header injection)
$nome = preg_replace('/[\r\n\t]+/', ' ', $nome);
if (mb_strlen($nome) < 2 || mb_strlen($nome) > 100) {
    $erros[] = 'Informe seu nome.';
}

// e-mail: formato válido (filter_var rejeita quebras de linha)
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
    $erros[] = 'Informe um e-mail válido.';
}

// whatsapp: opcional, só dígitos e símbolos comuns de telefone
if ($whatsapp !== '' && !preg_match('/^[\d\s()+\-.]{8,20}$/', $whatsapp)) {
    $erros[] = 'WhatsApp inválido.';
}

// assunto: whitelist
if (!array_key_exists($assunto, $assuntosValidos)) {
    $erros[] = 'Selecione um assunto.';
}

// mensagem: 5–3000 chars
if (mb_strlen($mensagem) < 5 || mb_strlen($mensagem) > 3000) {
    $erros[] = 'Escreva uma mensagem (mínimo de 5 caracteres).';
}

if ($erros) {
    respond(422, false, implode(' ', $erros));
}

// ---------- configuração ----------
$configFile = __DIR__ . '/config/config.php';
if (!is_file($configFile)) {
    error_log('FALAI: config/config.php não encontrado.');
    respond(500, false, 'Erro interno. Tente novamente mais tarde.');
}
$config = require $configFile;

// ---------- banco de dados ----------
$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$ua = mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255);

try {
    $db = $config['db'];
    $pdo = new PDO(
        "mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}",
        $db['user'],
        $db['pass'],
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );

    // rate limit por IP (janela deslizante via banco)
    if ($ip !== null) {
        $rl = $config['rate_limit'];
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) AS n FROM contatos
              WHERE ip = :ip AND criado_em > (NOW() - INTERVAL :win MINUTE)'
        );
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':win', (int)$rl['window_min'], PDO::PARAM_INT);
        $stmt->execute();
        if ((int)$stmt->fetch()['n'] >= (int)$rl['max_per_ip']) {
            respond(429, false, 'Muitas tentativas. Aguarde alguns minutos e tente novamente.');
        }
    }

    $stmt = $pdo->prepare(
        'INSERT INTO contatos (nome, email, whatsapp, assunto, mensagem, ip, user_agent)
         VALUES (:nome, :email, :whatsapp, :assunto, :mensagem, :ip, :ua)'
    );
    $stmt->execute([
        ':nome'     => $nome,
        ':email'    => $email,
        ':whatsapp' => $whatsapp !== '' ? $whatsapp : null,
        ':assunto'  => $assunto,
        ':mensagem' => $mensagem,
        ':ip'       => $ip,
        ':ua'       => $ua !== '' ? $ua : null,
    ]);
    $contatoId = (int)$pdo->lastInsertId();
} catch (PDOException $e) {
    error_log('FALAI DB: ' . $e->getMessage());
    respond(500, false, 'Erro interno ao salvar. Tente novamente mais tarde.');
}

// ---------- e-mail ----------
$emailEnviado = false;
$mailCfg = $config['mail'];

if (!empty($mailCfg['enabled'])) {
    $assuntoLabel = $assuntosValidos[$assunto];

    $body = "Novo contato pelo site Falaí\n"
          . "============================\n\n"
          . "Nome:     {$nome}\n"
          . "E-mail:   {$email}\n"
          . "WhatsApp: " . ($whatsapp !== '' ? $whatsapp : '—') . "\n"
          . "Assunto:  {$assuntoLabel}\n\n"
          . "Mensagem:\n{$mensagem}\n\n"
          . "----------------------------\n"
          . "Registro #{$contatoId} · " . date('d/m/Y H:i:s') . "\n";

    $smtpCfg = $config['smtp'];
    $mailer = new Mailer(true);

    try {
        $mailer->isSMTP();
        $mailer->Host       = $smtpCfg['host'];
        $mailer->SMTPAuth   = true;
        $mailer->Username   = $smtpCfg['user'];
        $mailer->Password   = $smtpCfg['pass'];
        $mailer->SMTPSecure = $smtpCfg['secure'] === 'tls'
            ? Mailer::ENCRYPTION_STARTTLS
            : Mailer::ENCRYPTION_SMTPS;
        $mailer->Port       = $smtpCfg['port'];
        $mailer->CharSet    = 'UTF-8';

        $mailer->setFrom($mailCfg['from'], $mailCfg['from_name']);
        $mailer->addAddress($mailCfg['to']);
        $mailer->addReplyTo($email, $nome);

        $mailer->Subject = $mailCfg['subject_prefix'] . $assuntoLabel . ' — ' . $nome;
        $mailer->Body    = $body;
        $mailer->isHTML(false);

        $mailer->send();
        $emailEnviado = true;
    } catch (MailerException $e) {
        error_log('FALAI MAIL: ' . $mailer->ErrorInfo);
    }

    if ($emailEnviado) {
        try {
            $pdo->prepare('UPDATE contatos SET email_enviado = 1 WHERE id = :id')
                ->execute([':id' => $contatoId]);
        } catch (PDOException $e) {
            error_log('FALAI DB update: ' . $e->getMessage());
        }
    }
}

// ---------- sucesso ----------
$_SESSION['form_hits'][] = $now;

respond(200, true, 'Mensagem enviada com sucesso! Logo a gente responde.');
