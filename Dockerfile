FROM php:7.3-cli

RUN mkdir -p /var/www/site

RUN pecl install xdebug-2.7.0 \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/site