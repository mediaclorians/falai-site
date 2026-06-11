# ============================================================
# FALAÍ — PHP 8.3 + Apache + msmtp (relay SMTP p/ Hostinger)
# ============================================================
FROM php:8.3-apache

# msmtp: encaminha o mail() do PHP para o SMTP autenticado
RUN apt-get update \
 && apt-get install -y --no-install-recommends msmtp ca-certificates \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql \
 && a2enmod rewrite headers expires

# .htaccess precisa de AllowOverride All
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
 && echo 'ServerName localhost' >> /etc/apache2/apache2.conf

COPY docker/php.ini /usr/local/etc/php/conf.d/zz-falai.ini
COPY docker/entrypoint.sh /usr/local/bin/falai-entrypoint
RUN chmod +x /usr/local/bin/falai-entrypoint

COPY site/ /var/www/html/

ENTRYPOINT ["falai-entrypoint"]
CMD ["apache2-foreground"]
