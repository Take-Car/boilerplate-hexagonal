FROM composer:2.7.1 AS composer

FROM php:8.3-cli-alpine3.17 AS base

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /opt/code

ENV PATH="${PATH}:/usr/bin/composer"

FROM base AS rector

RUN mkdir -p /opt/rector

COPY ./rector/composer.json ./rector/composer.lock ./rector/rector.php /opt/rector/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/rector

ENV PATH="${PATH}:/opt/rector/vendor/bin"

FROM base AS phpstan

RUN mkdir -p /opt/phpstan

COPY ./phpstan/composer.json ./phpstan/composer.lock /opt/phpstan/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/phpstan

ENV PATH="${PATH}:/opt/phpstan/vendor/bin"

FROM base AS deptrac

RUN mkdir -p /opt/deptrac

COPY ./deptrac/composer.json ./deptrac/composer.lock /opt/deptrac/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/deptrac

ENV PATH="${PATH}:/opt/deptrac/vendor/bin"

FROM base AS cs-fixer

RUN mkdir -p /opt/cs-fixer

COPY ./cs-fixer/composer.json ./cs-fixer/composer.lock /opt/cs-fixer/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/cs-fixer

ENV PATH="${PATH}:/opt/cs-fixer/vendor/bin"

FROM base AS phpspec

ENV XDEBUG_MODE=coverage

RUN apk add --no-cache gcc g++ make autoconf linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del --no-network gcc g++ make autoconf linux-headers

RUN mkdir -p /opt/phpspec

COPY ./phpspec/composer.json ./phpspec/composer.lock /opt/phpspec/

RUN composer install --no-progress --no-interaction --no-plugins --no-scripts --prefer-dist --no-cache --working-dir=/opt/phpspec

ENV PATH="${PATH}:/opt/phpspec/vendor/bin"
