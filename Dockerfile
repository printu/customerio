FROM php:8.1-cli

RUN mkdir -p /var/www/site

RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/site