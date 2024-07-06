FROM node:22.2.0-alpine3.19 AS base

RUN corepack enable

WORKDIR /app

FROM base AS dev

CMD [ "yarn", "dev" ]

FROM base AS build

ENV NODE_ENV=production

COPY ./package.json ./yarn.lock ./.yarnrc.yml ./

RUN yarn install --frozen-lockfile

COPY . .

RUN yarn build \
  # Move the static files to a standalone directory
  # Ideally those files should be served by a CDN
  && cp -r .next/static .next/standalone/.next/ \
  && cp -r public .next/standalone/

FROM node:22.2.0-alpine3.19 AS release

WORKDIR /app

COPY --from=build /app/.next/standalone /app/

ENTRYPOINT [ "node" ]
CMD [ "server.js" ]
