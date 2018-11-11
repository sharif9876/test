FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client zlib1g-dev unzip --no-install-recommends \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-enable mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

ENV PATH="/root/.composer/vendor/bin:${PATH}"