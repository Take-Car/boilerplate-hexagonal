# Hexagonal boilerplate

This template project aim to start a new project with the hexagonal architecture.

## Hexagonal architecture

The hexagonal architecture intends to separate an application: user-side ; business logic ; server-side. The application depends on the business logic and the architecture, but the business logic can't depends on something else than itself.

## Stack

This boilerplate is built with React and Symfony for learning purpose. You can replace each part at your convenience.

We will use Docker to make a development environment with 5 services:

- NodeJS to build the frontend
- PHP 8.1 as interpreter for the backend stack
- Nginx as HTTP Server
- MySQL as DBMS
- Traefik as reverse proxy (to replace 127.0.0.1 or localhost with local hostname)

## Installation

Rather than using GNU Make, fancy commands shortcuts are writen with (Taskfile)[https://taskfile.dev/]. You can install it via their website, they also provide a convenient script to install it on Linux based system:

```sh
sudo sh -c "$(curl --location https://taskfile.dev/install.sh)" -- -d -b /usr/local/bin
```

Once done, you can simply use `task` to start containers, lint files and run tests.

Available tasks for this project:

| commands            |   Description                                           |
| ------------------- | ------------------------------------------------------- |
| back:compile        | 	Generate GraphQL definitions proxies                  |
| back:php-cs-fixer   | 	Enforce code style                                    |
| back:phpstan        | 	Static analysis                                       |
| core:certs          |		Generate SSL certificates                             |
| core:compile        | 	Generate GraphQL definition proxies and typed hooks   |
| docker:build        | 	Build container images                                |
| docker:start        | 	Start containers                                      |
| docker:stop         |   Stop and remove containers                            |
| front:compile       | 	Generate typed hooks                                  |
| front:eslint        | 	Enforce code style                                    |
| front:jest          |   Run unit tests (Jest)                                 |
