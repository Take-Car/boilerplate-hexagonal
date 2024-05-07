FROM composer:2.7.6 AS composer

WORKDIR /app

COPY composer.* ./

RUN composer install \
    --ignore-platform-reqs \
    --no-scripts \
    --optimize-autoloader

#####################################

FROM php:8.3-fpm-alpine3.17 AS base

WORKDIR /app

ARG UID=1000
ARG GID=1000

RUN mkdir -p /app && chown -R $UID:$GID /app

RUN addgroup -g $GID user \
    && adduser -D -u $UID -G user user \
    && chown -R user:user /app

RUN apk add --no-cache \
    autoconf \
    bash \
    git \
    libzip-dev \
    icu-dev \
    rabbitmq-c-dev

RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS}

RUN pecl install apcu amqp && docker-php-ext-enable apcu amqp

RUN docker-php-ext-configure zip && docker-php-ext-install -j"$(nproc)" \
    zip \
    intl \
    opcache \
    pdo \
    pdo_mysql

RUN apk del --no-network .phpize-deps

COPY php/php.ini /usr/local/etc/php/php.ini

COPY --chown=$UID:$GID . /app

ENV PATH="$PATH:/app/bin"

USER user

#####################################

FROM base AS vendor-dev

COPY --from=composer              /usr/bin/composer /usr/local/bin/composer
COPY --from=composer --chown=1000 /app/vendor   /app/vendor

RUN composer check-platform-reqs --lock

#####################################

FROM vendor-dev AS vendor-no-dev

RUN composer install \
    --no-dev \
    --no-scripts \
    --optimize-autoloader

#####################################

FROM base AS dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

COPY --from=composer   /usr/bin/composer /usr/local/bin/composer
COPY --from=vendor-dev /app/vendor   /app/vendor
COPY                   php/conf.d-dev/*  /usr/local/etc/php/conf.d/

USER 0

RUN apk add --no-cache gcc g++ make autoconf linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del --no-network gcc g++ make autoconf linux-headers

USER user

#####################################

FROM dev AS test

ENV APP_ENV=test

COPY php/conf.d-test/* /usr/local/etc/php/conf.d/
COPY php/php-test.ini  /usr/local/etc/php/php.ini

#####################################

FROM base AS prod

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY                     php/conf.d/* /usr/local/etc/php/conf.d/
COPY --from=dependencies /app         /app
