# Hexagonal boilerplate

This template project aim to start a new project with the hexagonal architecture.

## Hexagonal architecture

The hexagonal architecture intends to separate an application: user-side ; business logic ; server-side. The application depends on the business logic and the architecture, but the business logic can't depends on something else than itself.

## Stack

This boilerplate is built with React and Symfony for learning purpose. You can replace each part at your convenience.

We will use Docker to make a development environment with 5 services:

- NodeJS
- PHP 8.2
- Nginx
- MySQL
- Traefik

## Installation

Rather than using GNU Make, fancy commands shortcuts are writen with [Taskfile](https://taskfile.dev/). You can install it via their website, they also provide a convenient script to install it on Linux based system:

```sh
sudo sh -c "$(curl --location https://taskfile.dev/install.sh)" -- -d -b /usr/local/bin
```

Available tasks for this project:
* dev:        Build and start the Docker containers      (aliases: default)
* ssl:        Generate local SSL certificates
* stop:       Stop and remove the Docker containers      (aliases: down)

## Start development

Simply run `task` in a terminal (or `task dev`). Once the command is done, you can open your browser on the following URLs:

- [Traefik dashboard](https://traefik.app.localhost)
- [Frontend](https://frontend.app.localhost)
- [Symfony Profiler](https://api.app.localhost/_profiler)