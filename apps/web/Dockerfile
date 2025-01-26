FROM node:23.3.0-alpine3.19 AS light

FROM light AS base

RUN corepack enable
ENV COREPACK_ENABLE_DOWNLOAD_PROMPT=0

WORKDIR /app

FROM base AS dev

CMD [ "yarn", "dev" ]

FROM base AS test

ENV NODE_ENV=test

COPY package.json yarn.lock .yarnrc.yml ./

RUN yarn install --immutable && yarn cache clean

COPY . .

FROM test AS build

ENV NODE_ENV=production

RUN yarn build \
  # Move the static files to a standalone directory
  # Ideally those files should be served by a CDN
  && cp -r .next/static .next/standalone/.next/ \
  && cp -r public .next/standalone/

FROM light AS release

WORKDIR /app

COPY --from=build /app/.next/standalone /app/

ENTRYPOINT [ "node" ]
CMD [ "server.js" ]
