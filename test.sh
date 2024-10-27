#!/bin/bash

# Set Git configuration
git config --global user.name "adityamp1"
git config --global user.email "2020wa86039@wilp.bits-pilani.ac.in"

# Install required packages
sudo apt update
sudo apt install -y apache2 php php-mysql docker.io docker-compose

# Clone the repository (GitHub token should be managed securely in Jenkins)
REPO_URL="https://github.com/adityamp1/post.git"
git clone $REPO_URL

# Copy PHP files to Apache web root
sudo cp post/*.php /var/www/html/

# Remove the default index.html if it exists
sudo rm -f /var/www/html/index.html

# Change directory to the cloned repo
cd post

# Start Docker Compose in detached mode
sudo docker-compose up -d
