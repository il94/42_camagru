FROM php:7.4-fpm

# Mettre à jour les dépôts et installer les dépendances nécessaires
RUN apt-get update \
    && apt-get install -y \
        zlib1g-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        msmtp \
        libmagickwand-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Copier le fichier de configuration PHP personnalisé
COPY php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Configurer msmtp
COPY msmtprc /etc/msmtprc
RUN chown root:msmtp /etc/msmtprc \
    && chmod 640 /etc/msmtprc \
    && mkdir -p /var/log \
    && touch /var/log/msmtp.log \
    && chown www-data:www-data /var/log/msmtp.log \
    && chmod 600 /var/log/msmtp.log
