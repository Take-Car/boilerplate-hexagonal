FROM node:22.2.0-alpine3.19 AS local

FROM local AS base

RUN corepack enable

WORKDIR /app

FROM base AS dev

CMD [ "yarn", "dev" ]

FROM base AS build

ENV NODE_ENV=production

COPY apps/web/package.json apps/web/yarn.lock apps/web/.yarnrc.yml ./

RUN corepack install && yarn install --immutable

COPY apps/web .

RUN yarn build \
  # Move the static files to a standalone directory
  # Ideally those files should be served by a CDN
  && cp -r .next/static .next/standalone/.next/ \
  && cp -r public .next/standalone/

FROM local AS release

WORKDIR /app

COPY --from=build --chown=1000:1000 /app/.next/standalone /app/

ENTRYPOINT [ "node" ]
CMD [ "server.js" ]

USER 1000:1000
