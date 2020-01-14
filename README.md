# Alexa Skill PHP Skeleton

PHP skeleton project for an easy creation of an API to be use on Amazon Alexa's Skill implementation. 

This project uses open source software such as:

- Symfony 5 (as a main framework).
- Docker and Docker Compose (Development environment).

etc.

---

## 📜 Table of contents

- [⚙️ Installation](#-installation)
- [🏗️ Development](#️-development)

## ⚙️ Installation  

### Prerequisites
Before you start, make sure you have installed and configured:

* [Docker](https://docs.docker.com/install/) and [Docker Compose](https://docs.docker.com/compose/install/)

### First time install

- Add in `/etc/hosts` the following registry: `0.0.0.0 alexa-api.local`
- Copy `etc/docker/dev/docker-compose.yml.dist` to root folder removing `.dist` extension.
- Execute `composer install --no-interaction` inside of the docker container, to enter use `docker exec -it alexa-skill_fpm sh`. 
- Check the installation running the test inside the container `bin/phpunit` 
- Check the installation in the browser using the health check endpoint: http://alexa-api.local/alexa/api/v1/ping

## 🏗️ Development

