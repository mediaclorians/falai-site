-- ============================================================
-- FALAÍ — Banco de dados do formulário de contato
-- Executar uma vez: mysql -u root -p < schema.sql
-- (ou colar no phpMyAdmin)
-- ============================================================

CREATE DATABASE IF NOT EXISTS falai
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE falai;

CREATE TABLE IF NOT EXISTS contatos (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome          VARCHAR(100)  NOT NULL,
  email         VARCHAR(150)  NOT NULL,
  whatsapp      VARCHAR(20)   NULL,
  assunto       VARCHAR(20)   NOT NULL,
  mensagem      TEXT          NOT NULL,
  ip            VARCHAR(45)   NULL,           -- suporta IPv6
  user_agent    VARCHAR(255)  NULL,
  email_enviado TINYINT(1)    NOT NULL DEFAULT 0,
  criado_em     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_criado_em (criado_em),
  KEY idx_ip_criado (ip, criado_em)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuário dedicado com privilégios mínimos (recomendado em produção).
-- Troque 'SENHA_FORTE_AQUI' antes de executar:
--
-- CREATE USER IF NOT EXISTS 'falai_app'@'localhost' IDENTIFIED BY 'SENHA_FORTE_AQUI';
-- GRANT INSERT, SELECT ON falai.contatos TO 'falai_app'@'localhost';
-- FLUSH PRIVILEGES;
