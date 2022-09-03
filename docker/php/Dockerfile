FROM composer:2.3.5 AS composer

FROM php:8.1-fpm AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt update \
    && apt install -y --no-install-recommends zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

ENV PATH="$PATH:/app/bin"

WORKDIR /app
USER 1000:1000

FROM base AS dev
