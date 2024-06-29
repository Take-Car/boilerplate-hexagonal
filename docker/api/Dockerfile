FROM composer:2.7.6 AS composer

#####################################

FROM php:8.3-fpm-alpine3.17 AS base

WORKDIR /app

ARG UID=1000

RUN adduser -D -u ${UID} -G www-data user \
    && chown -R user:www-data /app

RUN mkdir -p /app && chown -R user:www-data /app

RUN apk update && apk add --no-cache \
    autoconf=2.71-r1 \
    bash=5.2.15-r0 \
    git=2.38.5-r0 \
    libzip-dev=1.9.2-r2 \
    icu-dev=72.1-r1 \
    rabbitmq-c-dev=0.11.0-r5 \
    nginx=1.22.1-r1

# hadolint ignore=DL3018,SC2086
RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS}

RUN pecl install apcu amqp && docker-php-ext-enable apcu amqp

RUN docker-php-ext-configure zip && docker-php-ext-install -j"$(nproc)" \
    zip \
    intl \
    opcache \
    pdo \
    pdo_mysql

RUN apk del --no-network .phpize-deps

COPY --chown=user:www-data --chmod=550 docker/api/php/www.conf         /usr/local/etc/php-fpm.d/www.conf
COPY --chown=user:www-data --chmod=550 docker/api/nginx/nginx.conf     /etc/nginx/nginx.conf
COPY --chown=user:www-data --chmod=550 docker/api/nginx/site.conf      /etc/nginx/conf.d/default.conf
COPY --chown=user:www-data --chmod=550 docker/api/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chown -R user:www-data /var/lib/nginx && chmod -R 770 /var/lib/nginx \
    && chown -R user:www-data /var/log/nginx && chmod -R 770 /var/log/nginx

USER user:www-data

CMD ["nginx", "-g", "daemon off;"]
ENTRYPOINT ["docker-entrypoint.sh"]

#####################################

FROM base AS dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY docker/api/php/php-dev.ini /usr/local/etc/php/php.ini

#####################################

FROM dev AS test

ENV APP_ENV=test
ENV APP_DEBUG=0

COPY docker/api/php/php-test.ini /usr/local/etc/php/php.ini

#####################################

FROM base AS release

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY --from=composer --chown=user:www-data /usr/bin/composer /usr/local/bin/composer
COPY --chown=user:www-data apps/api /app/
COPY --chown=user:www-data docker/api/php/php-prod.ini /usr/local/etc/php/php.ini

RUN composer install --no-dev --no-scripts --no-interaction --no-progress \
    && composer dump-autoload --optimize --no-dev --classmap-authoritative

HEALTHCHECK --interval=60s --timeout=5s \
    CMD [ "200" = "$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1/ping)" ] || exit 1
