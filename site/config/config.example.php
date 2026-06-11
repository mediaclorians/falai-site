<?php
/**
 * FALAÍ — Configuração da aplicação (MODELO)
 *
 * 1. Copie este arquivo para config.php (mesma pasta).
 * 2. Preencha com os dados reais do seu ambiente.
 * 3. NUNCA versione/commite o config.php nem o exponha publicamente.
 *    O .htaccess na raiz já bloqueia acesso direto à pasta /config.
 */

return [
    // ---------- Banco de dados ----------
    'db' => [
        'host'    => 'localhost',
        'name'    => 'falai',
        'user'    => 'falai_app',      // em dev local (XAMPP) pode ser 'root'
        'pass'    => 'SENHA_FORTE_AQUI',
        'charset' => 'utf8mb4',
    ],

    // ---------- E-mail ----------
    'mail' => [
        // false = só grava no banco (útil em dev local sem servidor de e-mail)
        'enabled' => true,

        // Para quem o formulário envia
        'to'   => 'contato@falaicamiseta.com.br',

        // Remetente: use um e-mail DO SEU DOMÍNIO para não cair em spam
        'from'      => 'site@falaicamiseta.com.br',
        'from_name' => 'Site Falaí',

        // Prefixo do assunto do e-mail
        'subject_prefix' => '[Site Falaí] ',
    ],

    // ---------- Anti-abuso ----------
    'rate_limit' => [
        'max_per_ip'   => 5,    // envios por IP...
        'window_min'   => 10,   // ...a cada X minutos
    ],
];
