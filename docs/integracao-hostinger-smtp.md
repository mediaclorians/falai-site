# Integração: SMTP Hostinger (envio do formulário de contato)

> Fonte de verdade para o disparo de e-mails do site. Verificado na documentação oficial em 2026-06-09.

## Dados de conexão

| Item | Valor |
|---|---|
| Servidor SMTP | `smtp.hostinger.com` (Hostinger Email) |
| Porta | `465` (SSL implícito) — alternativa: `587` (STARTTLS) |
| Autenticação | usuário = **e-mail completo** (ex.: `site@falaicamiseta.com.br`), senha = senha da conta de e-mail |
| Custo | **Grátis** — incluído no plano de hospedagem/e-mail da Hostinger |
| Variante Titan | Se o e-mail do domínio for Titan: `smtp.titan.email`, porta `465` |

Fontes:
- [Email Account Configuration Details — Hostinger](https://support.hostinger.com/en/articles/1575756-how-to-get-email-account-configuration-details-for-hostinger-email)
- [Does Hostinger Support POP3, IMAP, and SMTP?](https://support.hostinger.com/en/articles/1583644-does-hostinger-support-pop3-imap-and-smtp)
- [Is SMTP Port 25 Blocked on Hostinger VPS?](https://support.hostinger.com/en/articles/7854530-is-smtp-port-25-blocked-on-vps) — porta 25 é bloqueada na VPS; **use 465/587** (não afeta este setup)

## Como o site usa

Não há biblioteca no código. O fluxo é:

```
contact.php → mail() do PHP → sendmail_path (docker/php.ini) → msmtp → smtp.hostinger.com:465
```

- O `msmtp` é instalado na imagem Docker ([Dockerfile](../Dockerfile)).
- O [docker/entrypoint.sh](../docker/entrypoint.sh) gera `/etc/msmtprc` no boot do container a partir das variáveis `SMTP_*` do `.env`.
- Credenciais ficam **só no `.env`** (nunca no código). Modelo: [env.modelo.txt](../env.modelo.txt).

## Regras importantes

1. **O remetente (`MAIL_FROM`) deve ser a mesma conta autenticada (`SMTP_USER`)** — a Hostinger rejeita envio com From divergente.
2. O `Reply-To` é o e-mail do visitante, então responder a mensagem responde direto para a pessoa.
3. Limites da Hostinger: contas de e-mail têm limite de envio por dia (centenas/dia, suficiente para formulário de contato; não usar para newsletter em massa).
4. Falha de envio **não perde a mensagem**: o contato fica salvo na tabela `contatos` com `email_enviado = 0` e o erro vai para o log do container (`docker compose logs web`).

## Teste rápido dentro do container

```bash
docker compose exec web sh -c 'printf "To: voce@dominio.com\nSubject: teste\n\ncorpo do teste\n" | msmtp voce@dominio.com'
```
