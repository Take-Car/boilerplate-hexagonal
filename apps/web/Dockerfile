FROM node:21.4.0-alpine3.17 AS base

RUN apk add --no-cache \
  python3=~3.10 \
  make=~4.3-r1 \
  gcc=~12.2 \
  g++=~12.2

WORKDIR /app
