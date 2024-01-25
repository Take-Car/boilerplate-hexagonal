FROM composer:2.6.6 AS composer

FROM php:8.3-cli-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /opt/code

ENV PATH="${PATH}:/usr/bin/composer"

FROM base AS rector

RUN mkdir -p /opt/rector

COPY ./rector/composer.json ./rector/composer.lock ./rector/rector.php /opt/rector

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/rector

ENV PATH="${PATH}:/opt/rector/vendor/bin"

FROM base AS phpstan

RUN mkdir -p /opt/phpstan

COPY ./phpstan/composer.json ./phpstan/composer.lock /opt/phpstan

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/phpstan

ENV PATH="${PATH}:/opt/phpstan/vendor/bin"

FROM base AS deptrac

RUN mkdir -p /opt/deptrac

COPY ./deptrac/composer.json ./deptrac/composer.lock /opt/deptrac

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/deptrac

ENV PATH="${PATH}:/opt/deptrac/vendor/bin"

FROM base AS cs-fixer

RUN mkdir -p /opt/cs-fixer

COPY ./cs-fixer/composer.json ./cs-fixer/composer.lock /opt/cs-fixer

RUN composer install --dev --no-progress --no-suggest --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/cs-fixer

ENV PATH="${PATH}:/opt/cs-fixer/vendor/bin"
