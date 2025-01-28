[![.github/workflows/backend.yaml](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/backend.yaml/badge.svg)](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/backend.yaml)
[![.github/workflows/frontend.yaml](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/frontend.yaml/badge.svg)](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/frontend.yaml)
[![.github/workflows/services.yaml](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/services.yaml/badge.svg)](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/services.yaml)
[![Dependabot Updates](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/clementvtrd/boilerplate-hexagonal/actions/workflows/dependabot/dependabot-updates)

# Hexagonal boilerplate

## Hexagonal architecture

The hexagonal architecture is a software architectural pattern that promotes a clear separation of concerns and decoupling of components. It emphasizes the idea of organizing an application into concentric layers, with the core business logic at the center, surrounded by layers representing external interfaces, such as UI, databases, and external services.

In the hexagonal architecture, the core business logic is independent of the external infrastructure and frameworks. It is encapsulated within the innermost layer and is unaware of how the application interacts with external systems. Instead, the external systems are abstracted through interfaces called "ports." Adapters are responsible for implementing these ports and bridging the gap between the core business logic and the external systems.

This architecture enables better testability, maintainability, and flexibility. It allows for easy swapping of external components, as long as they adhere to the defined ports' interfaces. Changes in the external systems do not impact the core business logic, making the application more resilient to modifications and evolutions.

Overall, the hexagonal architecture promotes a modular, clean, and adaptable design by separating concerns and dependencies, leading to a more robust and maintainable software system..

## Stack

This boilerplate is built with Symfony for learning purpose. You can replace each part at your convenience.

We will use Docker to make a development environment with 5 services:

- Traefik: as a reverse proxy
- Nginx + PHP: serves the Symfony API
- MySQL: to store our data
- RabbitMQ: messaging queue system (in pair with Symfony Messenger)
- Node: develop, build and serve NextJS application

## Installation

### Docker

This boilerplate was built around with [Orbstack](https://orbstack.dev) (which can replace Docker Desktop on MacOS).

### Taskfile

The project uses [Taskfile](https://taskfile.dev/) to create CLI shortcuts. You can install it via its website, they also provide a convenient script to install it on common systems:

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

---

You can now use `task --list` to show all the available commands

## URLs

- [NextJS frontend](https://app.localhost)
- [Symfony API](https://api.app.localhost)
- [Traefik dashboard](https://traefik.app.localhost)
- [Rabbit MQ monitor](https://rabbitmq.app.localhost)
