#!/bin/bash

# Configure Git global settings
#git config --global user.name "adityamp1"
#git config --global user.email "2020wa86039@wilp.bits-pilani.ac.in"

# Clone the GitHub repository
#git clone https://adityamp1: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@github.com/adityamp1/post

# Update package list and install dependencies
sudo apt-get update
sudo apt-get install -y apache2 php php-mysql apt-transport-https ca-certificates curl software-properties-common

# Install Docker and Docker Compose
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Copy PHP files to Apache web root
sudo cp post/*.php /var/www/html/

# Remove the default index.html if it exists
sudo rm -f /var/www/html/index.html

# Change directory to the cloned repo
cd post

# Start Docker Compose
sudo docker-compose up -d
