# Falaí Camiseta — Landing Page

Site institucional responsivo (HTML5 + CSS + JS vanilla + PHP + MySQL), baseado no layout do Figma.

> **Jeito recomendado de rodar: Docker** (local e na Hostinger VPS). Veja a seção [Docker](#rodando-com-docker-recomendado) abaixo. As instruções de XAMPP continuam válidas como alternativa.

## Rodando com Docker (recomendado)

Na **raiz do projeto** (um nível acima desta pasta):

```bash
# 1. Crie o .env a partir do modelo e preencha senhas do banco + SMTP Hostinger
#    (arquivo env.modelo.txt na raiz)

# 2. Suba a stack (web + MySQL, schema importado automaticamente)
docker compose up -d --build

# 3. Abra no navegador
#    http://localhost:8080   (porta definida por WEB_PORT no .env)
```

- O e-mail sai pelo **SMTP da Hostinger via msmtp** — grátis, sem serviço externo. Detalhes: [docs/integracao-hostinger-smtp.md](../docs/integracao-hostinger-smtp.md).
- A configuração do PHP lê as variáveis de ambiente do `.env` (veja `config/config.php`).
- Dados do MySQL persistem no volume `db_data` (`docker compose down` não apaga; `down -v` apaga).

### Deploy na Hostinger VPS

1. Envie o projeto para a VPS (git ou SFTP), sem o `.env`.
2. Crie o `.env` na VPS a partir do `env.modelo.txt` — defina `WEB_PORT=80` (ou mantenha 8080 atrás de um proxy/painel como Coolify/EasyPanel, que também resolve o HTTPS).
3. `docker compose up -d --build`
4. Ver logs: `docker compose logs -f web` · Conferir contatos: `docker compose exec db mysql -ufalai_app -p falai -e "SELECT * FROM contatos ORDER BY id DESC LIMIT 10;"`

## Estrutura

```
site/
├── index.php          # Landing page (gera token CSRF na sessão)
├── contact.php        # Handler do formulário (valida, salva no MySQL, envia e-mail)
├── .htaccess          # Segurança Apache (bloqueia config/sql, headers, cache)
├── assets/
│   ├── css/style.css  # Estilos (desktop + mobile)
│   ├── js/main.js     # Menu, carrossel, marquee, envio do form via fetch
│   └── img/           # Imagens otimizadas (geradas a partir de /material)
├── config/
│   ├── config.php           # Config local (XAMPP: root sem senha, e-mail OFF)
│   └── config.example.php   # Modelo para produção
└── sql/schema.sql     # Cria banco `falai` + tabela `contatos`
```

## Rodando localmente (XAMPP/Laragon)

1. Copie a pasta `site/` para o docroot (`htdocs/falai` no XAMPP) — ou aponte um vhost para ela.
2. Crie o banco: importe `sql/schema.sql` no phpMyAdmin (ou `mysql -u root < sql/schema.sql`).
3. Confira `config/config.php` (padrão: `root` sem senha, e-mail desligado — mensagens são gravadas no banco mesmo assim).
4. Acesse `http://localhost/falai`.

Sem Apache, dá para testar com o servidor embutido do PHP:

```
cd site
php -S localhost:8080
```

## Publicando em hospedagem compartilhada

1. Suba o conteúdo de `site/` para `public_html/`.
2. Crie o banco e o usuário no painel da hospedagem e rode `sql/schema.sql`
   (inclui o comando comentado para criar usuário com privilégio mínimo: só INSERT/SELECT em `contatos`).
3. Copie `config/config.example.php` para `config/config.php` e preencha:
   - dados do banco;
   - `mail.enabled = true`;
   - `mail.from` com um e-mail **do próprio domínio** (ex.: `site@falaicamiseta.com.br`) — crie essa conta no painel para o `mail()` ter remetente válido e não cair em spam.
4. Confirme que `https://seudominio/config/config.php` retorna **403** (o `.htaccess` faz isso).

### Upgrade recomendado de e-mail (futuro)

`mail()` funciona na maioria das hospedagens compartilhadas, mas para máxima entregabilidade o ideal é **PHPMailer + SMTP autenticado** (conta do domínio ou serviço como Brevo). A troca é isolada: só o bloco "e-mail" de `contact.php` muda.

## Segurança implementada

- **SQL injection**: PDO com prepared statements em todas as queries.
- **CSRF**: token de sessão validado com `hash_equals()`.
- **Spam/bots**: honeypot invisível + rate limit por sessão (3/10min) e por IP (5/10min, via banco).
- **Header injection no e-mail**: e-mail validado com `FILTER_VALIDATE_EMAIL`, nome sem quebras de linha, headers só com valores codificados.
- **XSS**: nenhum dado do usuário é reexibido sem escape; CSP restritiva no `.htaccess`.
- **Exposição de arquivos**: `config/` e `sql/` bloqueados; sem listagem de diretórios.
- **Vazamento de erro**: exceções vão para `error_log`, nunca para o usuário.

## Conteúdo

Textos vindos de `material/*.docx` (institucional). FAQ e Quem Somos têm texto pronto no material e podem virar páginas internas numa próxima etapa.
