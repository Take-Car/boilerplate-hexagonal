#!/bin/sh

php-fpm --daemonize

set -e

if [[ "$1" == -* ]]; then
    set -- nginx -g daemon off; "$@"
fi

exec "$@"
