FROM composer:2.7.7 AS composer

WORKDIR /app

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
    autoconf=2.71-r1 \
    bash=5.2.15-r0 \
    git=2.38.5-r0 \
    libzip-dev=1.9.2-r2 \
    icu-dev=72.1-r1 \
    rabbitmq-c-dev=0.11.0-r5 \
    nginx=1.22.1-r1

# hadolint ignore=DL3018,SC2086
RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS} \
    && pecl install apcu amqp && docker-php-ext-enable apcu amqp \
    && docker-php-ext-configure zip && docker-php-ext-install -j"$(nproc)" \
        zip \
        intl \
        opcache \
        pdo \
        pdo_mysql

RUN apk del --no-network .phpize-deps

COPY --chown=$UID:$GID . /app

ENV PATH="$PATH:/app/bin"

USER user

#####################################

FROM base AS dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

COPY php/php-dev.ini /usr/local/etc/php/php.ini
COPY --from=composer   /usr/bin/composer /usr/local/bin/composer

#####################################

FROM dev AS test

ENV APP_ENV=test

COPY php/php-test.ini /usr/local/etc/php/php.ini

USER 0

RUN apk add --no-cache \
    gcc=12.2.1_git20220924-r4 \
    g++=12.2.1_git20220924-r4 \
    make=4.3-r1 \
    autoconf=2.71-r1 \
    linux-headers=5.19.5-r0 \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del --no-network gcc g++ make autoconf linux-headers

USER user

#####################################

FROM composer AS vendor

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --optimize-autoloader \
    --ignore-platform-reqs

#####################################

FROM base AS prod

ENV APP_ENV=prod
ENV APP_DEBUG=0


COPY php/php-prod.ini /usr/local/etc/php/php.ini
COPY . .
COPY --from=vendor /app/vendor /app/vendor

RUN composer dump-autoload --optimize \
    && composer check-platform-reqs
