# Hexagonal boilerplate

## Hexagonal architecture

The hexagonal architecture is a software architectural pattern that promotes a clear separation of concerns and decoupling of components. It emphasizes the idea of organizing an application into concentric layers, with the core business logic at the center, surrounded by layers representing external interfaces, such as UI, databases, and external services.

In the hexagonal architecture, the core business logic is independent of the external infrastructure and frameworks. It is encapsulated within the innermost layer and is unaware of how the application interacts with external systems. Instead, the external systems are abstracted through interfaces called "ports." Adapters are responsible for implementing these ports and bridging the gap between the core business logic and the external systems.

This architecture enables better testability, maintainability, and flexibility. It allows for easy swapping of external components, as long as they adhere to the defined ports' interfaces. Changes in the external systems do not impact the core business logic, making the application more resilient to modifications and evolutions.

Overall, the hexagonal architecture promotes a modular, clean, and adaptable design by separating concerns and dependencies, leading to a more robust and maintainable software system.

## Stack

This boilerplate is built with React and Symfony for learning purpose. You can replace each part at your convenience.

We will use Docker to make a development environment with 5 services:

- Traefik: as a reverse proxy
- Nginx + PHP 8.2: serves the Symfony API
- PostgreSQL 16: to store our data
- RabbitMQ: messaging queue system (in pair with Symfony Messenger)
- NodeJS 21: to build the frontend with NextJS

## Installation

### Taskfile

Rather than using GNU Make, fancy commands shortcuts are writen with [Taskfile](https://taskfile.dev/). You can install it via their website, they also provide a convenient script to install it on Linux based system:

#### Linux

```sh
sudo sh -c "$(curl --location https://taskfile.dev/install.sh)" -- -d -b /usr/local/bin
task
```

#### MacOS

```sh
brew install go-task
task
```

#### Windows

```sh
winget install Task.Task # you may need to restart your session
task
```

## Commands

| Task     | Description                                               |
|----------|-----------------------------------------------------------|
| start    | Start the Docker containers detached                      |
| stop     | Stop the Docker containers                                |
| install  | Build and pull images, setup SSL and install dependencies |
| symfony  | Shortcut to interact with Symfony CLI                     |
| composer | Shortcut to run Composer commands                         |
| console  | Shortcut to interact with bin/console script              |
| phpstan  | Shortcut to run PHP Stan                                  |
| deptrac  | Shortcut to run Deptrac                                   |
| cs-fixer | Shortcut to run PHP CS Fixer                              |

## URLs

- [Symfony API](https://api.app.localhost)
- [Traefik dashboard](https://traefik.app.localhost)
- [Rabbit MQ monitor](https://rabbitmq.app.localhost)
