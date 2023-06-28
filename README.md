# Hexagonal boilerplate

> This repository is archived. It will no more receive updates.

## Hexagonal architecture

The hexagonal architecture is a software architectural pattern that promotes a clear separation of concerns and decoupling of components. It emphasizes the idea of organizing an application into concentric layers, with the core business logic at the center, surrounded by layers representing external interfaces, such as UI, databases, and external services.

In the hexagonal architecture, the core business logic is independent of the external infrastructure and frameworks. It is encapsulated within the innermost layer and is unaware of how the application interacts with external systems. Instead, the external systems are abstracted through interfaces called "ports." Adapters are responsible for implementing these ports and bridging the gap between the core business logic and the external systems.

This architecture enables better testability, maintainability, and flexibility. It allows for easy swapping of external components, as long as they adhere to the defined ports' interfaces. Changes in the external systems do not impact the core business logic, making the application more resilient to modifications and evolutions.

Overall, the hexagonal architecture promotes a modular, clean, and adaptable design by separating concerns and dependencies, leading to a more robust and maintainable software system.

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

- dev: Build and start the Docker containers (aliases: default)
- ssl: Generate local SSL certificates
- stop: Stop and remove the Docker containers (aliases: down)

## Start development

Simply run `task` in a terminal (or `task dev`). Once the command is done, you can open your browser on the following URLs:

- [Traefik dashboard](https://traefik.app.localhost)
- [Frontend](https://frontend.app.localhost)
- [Symfony Profiler](https://api.app.localhost/_profiler)
