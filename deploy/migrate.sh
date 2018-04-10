#!/bin/sh

docker-php-ext-install pdo_mysql
composer install
composer phinx