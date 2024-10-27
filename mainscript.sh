#!/bin/bash

git config --global user.name "adityamp1"
git config --global user.email "2020wa86039@wilp.bits-pilani.ac.in"

sudo apt install apache2 php php-mysql docker.io docker-compose  -y

sudo cp post/*.php /var/www/html/

rm /var/www/html/index.html

cd post

sudo docker-compose up -d
