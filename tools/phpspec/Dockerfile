FROM composer:2.8.2 AS composer

FROM php:8.3-cli-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /opt/code

ENV PATH="${PATH}:/usr/bin/composer"

RUN mkdir -p /opt/phpspec

COPY ./composer.json ./composer.lock /opt/phpspec/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/phpspec

ENV PATH="${PATH}:/opt/phpspec/vendor/bin"
