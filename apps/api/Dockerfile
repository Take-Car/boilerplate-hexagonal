FROM composer:2.6.5 AS composer

FROM php:8.2-fpm-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
    autoconf \
    bash \
    git \
    libzip-dev \
    postgresql15-dev \
    icu-dev
RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS}
RUN pecl install apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-configure zip
RUN docker-php-ext-install -j"$(nproc)" \
    zip \
    intl \
    opcache \
    pdo \
    pdo_pgsql
RUN apk del --no-network .phpize-deps

ENV PATH="$PATH:/app/bin"

WORKDIR /app

FROM base AS dev
