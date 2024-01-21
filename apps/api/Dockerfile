FROM composer:2.6.5 AS composer

FROM php:8.3-fpm-alpine3.17 AS base

RUN apk add --no-cache \
    autoconf \
    bash \
    git \
    libzip-dev \
    icu-dev \
    rabbitmq-c-dev
RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS}
RUN pecl install apcu amqp
RUN docker-php-ext-enable apcu amqp
RUN docker-php-ext-configure zip
RUN docker-php-ext-install -j"$(nproc)" \
    zip \
    intl \
    opcache \
    pdo \
    pdo_mysql
RUN apk del --no-network .phpize-deps

ENV PATH="$PATH:/app/bin"

WORKDIR /app

FROM base AS dev

FROM base AS cli

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache bash \
  && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
  && apk add --no-cache symfony-cli
