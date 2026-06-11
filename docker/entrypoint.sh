#!/bin/sh
# FALAÍ — gera /etc/msmtprc a partir das variáveis de ambiente (SMTP Hostinger)
set -e

if [ -n "${SMTP_HOST}" ] && [ -n "${SMTP_USER}" ]; then
    SMTP_PORT="${SMTP_PORT:-465}"
    # 465 = SSL implícito; 587 = STARTTLS
    if [ "${SMTP_PORT}" = "465" ]; then
        STARTTLS=off
    else
        STARTTLS=on
    fi

    cat > /etc/msmtprc <<EOF
defaults
auth on
tls on
tls_starttls ${STARTTLS}
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile /proc/self/fd/2

account default
host ${SMTP_HOST}
port ${SMTP_PORT}
user ${SMTP_USER}
password ${SMTP_PASS}
from ${MAIL_FROM:-${SMTP_USER}}
EOF
    chown www-data:www-data /etc/msmtprc
    chmod 600 /etc/msmtprc
    echo "msmtp configurado para ${SMTP_HOST}:${SMTP_PORT}"
else
    echo "AVISO: SMTP_HOST/SMTP_USER não definidos — envio de e-mail indisponível."
fi

exec "$@"
