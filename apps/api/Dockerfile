FROM composer:2.7.6 AS composer

#####################################

FROM php:8.3-fpm-alpine3.17 AS base

WORKDIR /app

ARG UID=1000

RUN adduser -D -u ${UID} -G www-data user \
    && chown -R user:www-data /app

RUN mkdir -p /app && chown -R user:www-data /app

RUN apk update && apk add --no-cache \
    autoconf \
    bash \
    git \
    libzip-dev \
    icu-dev \
    rabbitmq-c-dev \
    nginx

RUN apk add --no-cache --virtual .phpize-deps ${PHPIZE_DEPS}

RUN pecl install apcu amqp && docker-php-ext-enable apcu amqp

RUN docker-php-ext-configure zip && docker-php-ext-install -j"$(nproc)" \
    zip \
    intl \
    opcache \
    pdo \
    pdo_mysql

RUN apk del --no-network .phpize-deps

COPY --chown=user:www-data --chmod=550 php/www.conf           /usr/local/etc/php-fpm.d/www.conf
COPY --chown=user:www-data --chmod=550 nginx/nginx.conf       /etc/nginx/nginx.conf
COPY --chown=user:www-data --chmod=550 nginx/site.conf        /etc/nginx/conf.d/default.conf
COPY --chown=user:www-data --chmod=550 ./docker-entrypoint.sh /usr/local/bin/

RUN chown -R user:www-data /var/lib/nginx && chmod -R 770 /var/lib/nginx \
    && chown -R user:www-data /var/log/nginx && chmod -R 770 /var/log/nginx

USER user:www-data

HEALTHCHECK --start-interval=5s --interval=60s --timeout=5s \
    CMD [ "200" = "$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1/ping)" ] || exit 1

CMD ["nginx", "-g", "daemon off;"]
ENTRYPOINT ["docker-entrypoint.sh"]

#####################################

FROM base AS dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

COPY --from=composer --chmod=550 /usr/bin/composer /usr/local/bin/composer
COPY php/php-dev.ini   /usr/local/etc/php/php.ini

USER user:www-data

#####################################

FROM dev AS test

ENV APP_ENV=test

COPY php/php-test.ini /usr/local/etc/php/php.ini

USER user:www-data

#####################################

FROM composer AS vendor-no-dev

RUN composer install --no-dev --no-scripts

USER user:www-data

#####################################

FROM base AS release

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY --chown=user:www-data --chmod=660 config public src composer.json composer.lock symfony.lock /app
COPY --chown=user:www-data --chmod=770 bin /app
COPY --from=vendor-no-dev --chown=user:www-data --chmod=660 /app/vendor /app/vendor
COPY --chown=user:www-data --chmod=660 php/php-prod.ini /usr/local/etc/php/php.ini

USER user:www-data
