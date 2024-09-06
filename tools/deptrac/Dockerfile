FROM composer:2.7.9 AS composer

FROM php:8.3-cli-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /opt/code

ENV PATH="${PATH}:/usr/bin/composer"

RUN mkdir -p /opt/deptrac

COPY ./composer.json ./composer.lock /opt/deptrac/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/deptrac

ENV PATH="${PATH}:/opt/deptrac/vendor/bin"
