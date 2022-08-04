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
