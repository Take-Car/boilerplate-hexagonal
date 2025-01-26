FROM node:23.3.0-alpine3.19 AS base

RUN corepack enable
ENV COREPACK_ENABLE_DOWNLOAD_PROMPT=0

WORKDIR /app

FROM base AS dev

CMD [ "yarn", "dev" ]

FROM base AS test

RUN yarn install --immutable

FROM base AS build

ENV NODE_ENV=production

COPY ./package.json ./yarn.lock ./.yarnrc.yml ./

RUN yarn install --immutable

COPY . .

RUN yarn build \
  # Move the static files to a standalone directory
  # Ideally those files should be served by a CDN
  && cp -r .next/static .next/standalone/.next/ \
  && cp -r public .next/standalone/

FROM node:23.3.0-alpine3.19 AS release

WORKDIR /app

COPY --from=build /app/.next/standalone /app/

ENTRYPOINT [ "node" ]
CMD [ "server.js" ]
