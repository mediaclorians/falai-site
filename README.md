# Falaí Camiseta — Site Institucional

Landing page institucional da [Falaí Camiseta](https://falaicamiseta.com.br), marca brasileira de camisetas com propósito.

## Stack

- **PHP 8.3** + Apache
- **MySQL 8.4**
- **Docker Compose** + Traefik (HTTPS automático via Let's Encrypt)
- Vanilla JS e CSS puro (sem frameworks)

## Funcionalidades

- Formulário de contato com proteção CSRF e honeypot anti-spam
- Máscara de telefone para celular (5+4) e fixo (4+4)
- Carrossel de valores com suporte a swipe e teclado
- Scrollspy com IntersectionObserver
- Marquee animado
- Rate limiting por IP
- Headers de segurança (CSP, X-Frame-Options, etc.)

## Rodar localmente

**Pré-requisito:** Docker Desktop instalado e rodando.

```bash
git clone https://github.com/mediaclorians/falai-site.git
cd falai-site
cp env.modelo.txt .env
# edite o .env com suas credenciais
docker compose up --build -d
```

Acesse: http://localhost:8080

## Configuração

Copie `env.modelo.txt` para `.env` e preencha:

| Variável | Descrição |
|---|---|
| `DB_NAME` | Nome do banco de dados |
| `DB_USER` | Usuário do banco |
| `DB_PASS` | Senha do banco |
| `DB_ROOT_PASS` | Senha root do MySQL |
| `WEB_PORT` | Porta local (padrão: 8080) |
| `MAIL_ENABLED` | `true` para enviar e-mails |
| `SMTP_HOST` | Servidor SMTP |
| `SMTP_PORT` | Porta SMTP (465 = SSL, 587 = STARTTLS) |
| `SMTP_USER` / `SMTP_PASS` | Credenciais SMTP |

## Estrutura

```
site/
├── index.php              # Landing page principal
├── contact.php            # Endpoint do formulário
├── config/
│   └── config.example.php # Modelo de configuração
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   └── img/
└── sql/schema.sql         # Schema do banco
docker/
├── entrypoint.sh          # Configura msmtp para SMTP
└── php.ini
```

## Deploy (VPS com Traefik)

```bash
cd /docker/falai-site
git pull
docker compose up -d --build
```

O deploy automático via GitHub Actions é disparado a cada push na branch `main`.

## Variáveis de ambiente para produção

Em produção, não use `WEB_PORT` — o Traefik assume o roteamento via HTTPS.
O arquivo `.env` nunca deve ser commitado.
