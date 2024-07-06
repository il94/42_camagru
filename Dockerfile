FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev msmtp \
    && docker-php-ext-install pdo_mysql

COPY php.ini /usr/local/etc/php/conf.d/custom-php.ini

COPY msmtprc /etc/msmtprc
RUN chown root:msmtp /etc/msmtprc
RUN chmod 640 /etc/msmtprc
RUN mkdir -p /var/log
RUN touch /var/log/msmtp.log
RUN chown www-data:www-data /var/log/msmtp.log
RUN chmod 600 /var/log/msmtp.log