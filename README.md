# CXM - Car eXpenses Manager

[![CircleCI](https://circleci.com/gh/giefferre/car-expenses-manager.svg?style=svg)](https://circleci.com/gh/giefferre/car-expenses-manager)

A simple app to manage and track your car expenses 🚗 💵

## Introduction

Do you want to know how much money you are spending on your car(s)?
Car eXpenses Manager (CXM from now on) is for you.

## Features

CXM provides you with:

- Fleet management
- List of expenses in the last 12 months
- Reporting of overall cost

CXM is supposed to run as single user, as it has no authentication nor user management.
Think about this aspect before running it in public!

## Future features

- Setup of recurrent expenses
- Expenses reminder
- Custom period filter

---

## Components

CXM consists of two main components, a frontend application based on [AngularJS](https://docs.angularjs.org/api), and an API application written in PHP with [Slim](https://www.slimframework.com/), which stores data on a MySQL server.

All the operations (environment setup, DB migrations, etc) and the software components themselves are running within Docker containers.

## Installation

### Requirements

- An OS running [Docker](http://docker.io/) version 18.03.0 or higher
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Make](https://www.gnu.org/software/make/)
- [Git](https://git-scm.com/)

### Setup & Run

Running CXM is trivial:

```bash
git clone https://github.com/giefferre/car-expenses-manager
cd car-expenses-manager
make setup
make run
```

As CXM is configured to run on hosts `cxm.gieffer.re` (for the frontend app) and `cxm-api.gieffer.re` (for the API), please be sure to edit your `/etc/hosts` file adding the following lines:

    127.0.0.1   cxm.gieffer.re
    127.0.0.1   cxm-api.gieffer.re

Open your browser, point it to `cxm.gieffer.re` and have fun!

### Tests

```bash
make tests
```

---

## References

App frameworks and tools:

- [AngularJS](https://docs.angularjs.org/api)
- [Angular Best Practices: Directory Structure](https://scotch.io/tutorials/angularjs-best-practices-directory-structure)
- [Slim](https://www.slimframework.com/)
- [Phinx](https://phinx.org/)
- [PHPUnit](https://phpunit.de/)

Devops:

- [Docker Compose Getting Started Guide](https://docs.docker.com/compose/gettingstarted/)
- [Docker Compose: Wait For Dependencies](https://8thlight.com/blog/dariusz-pasciak/2016/10/17/docker-compose-wait-for-dependencies.html)
- [Automated nginx proxy for Docker containers](https://github.com/jwilder/nginx-proxy)
- [Nginx and php-fpm for dockerhub builds](https://hub.docker.com/r/richarvey/nginx-php-fpm/)

## Disclaimer

CXM is a test application developed for fun, so please consider it as a technology demo.
The following aspects were intentionally not taken in consideration - but they could be in a near future, who knows?

- Deleting cars and expenses
- Multi user support
- API authentication, flooding protection
- API integration tests
- AngularJS unit tests on the frontend app
- A slight better directory structure for API classes files

Feel free to fork the project and apply modifications!