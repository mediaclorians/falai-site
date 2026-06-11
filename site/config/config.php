<?php
/**
 * FALAÍ — Configuração da aplicação.
 *
 * Lê variáveis de ambiente (Docker / hospedagem) com fallback para
 * valores de desenvolvimento local (XAMPP: root sem senha, e-mail off).
 * Os segredos vivem no .env / painel — nunca neste arquivo.
 */

$env = static function (string $key, string $default = ''): string {
    $v = getenv($key);
    return ($v !== false && $v !== '') ? $v : $default;
};

return [
    'db' => [
        'host'    => $env('DB_HOST', 'localhost'),
        'name'    => $env('DB_NAME', 'falai'),
        'user'    => $env('DB_USER', 'root'),
        'pass'    => $env('DB_PASS', ''),
        'charset' => 'utf8mb4',
    ],

    'mail' => [
        'enabled' => filter_var($env('MAIL_ENABLED', 'false'), FILTER_VALIDATE_BOOLEAN),

        'to'        => $env('MAIL_TO', 'contato@falaicamiseta.com.br'),
        // remetente deve ser a mesma conta autenticada no SMTP (Hostinger)
        'from'      => $env('MAIL_FROM', $env('SMTP_USER', 'site@falaicamiseta.com.br')),
        'from_name' => $env('MAIL_FROM_NAME', 'Site Falaí'),
        'subject_prefix' => '[Site Falaí] ',
    ],

    'rate_limit' => [
        'max_per_ip' => 5,
        'window_min' => 10,
    ],
];
