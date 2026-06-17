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

        'to'             => $env('MAIL_TO',        'contato@falaicamiseta.com.br'),
        'from'           => $env('MAIL_FROM',      $env('SMTP_USER', 'contato@falaicamiseta.com.br')),
        'from_name'      => $env('MAIL_FROM_NAME', 'Site Falaí'),
        'subject_prefix' => '[Site Falaí] ',
    ],

    'smtp' => [
        'host'   => $env('SMTP_HOST',   'smtp.hostinger.com'),
        'port'   => (int) $env('SMTP_PORT',   '465'),
        'user'   => $env('SMTP_USER',   ''),
        'pass'   => $env('SMTP_PASS',   ''),
        'secure' => $env('SMTP_SECURE', 'ssl'), // 'ssl' para porta 465, 'tls' para 587
    ],

    'rate_limit' => [
        'max_per_ip' => 5,
        'window_min' => 10,
    ],
];
