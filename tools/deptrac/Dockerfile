FROM composer:2.6.5 AS composer

FROM php:8.3-fpm-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN mkdir -p /opt/deptrac

COPY composer.json composer.lock /opt/deptrac

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-scripts --no-autoloader --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/deptrac

ENV PATH="${PATH}:/opt/deptrac/vendor/bin"

WORKDIR /opt/code
