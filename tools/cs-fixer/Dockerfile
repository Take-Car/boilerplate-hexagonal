FROM composer:2.6.5 AS composer

FROM php:8.3-fpm-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN mkdir -p /opt/cs-fixer

COPY composer.json composer.lock /opt/cs-fixer

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/cs-fixer

ENV PATH="${PATH}:/opt/cs-fixer/vendor/bin"

WORKDIR /opt/code
