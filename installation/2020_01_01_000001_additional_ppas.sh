#!/bin/bash

GREEN='\033[0;32m'
NC='\033[0m' # No Color

#Ubuntu Deployment
echo -e "${GREEN}Adding PPAs${NC}"

# PHP
add-apt-repository ppa:ondrej/php -y

# Webmin
curl -fsSL https://download.webmin.com/jcameron-key.asc | gpg --dearmor -o /usr/share/keyrings/webmin.gpg
echo "deb [signed-by=/usr/share/keyrings/webmin.gpg] https://download.webmin.com/download/repository sarge contrib" \
>> /etc/apt/sources.list

# Cockpit & packages
curl -sSL https://repo.45drives.com/setup | sudo bash


apt update
apt upgrade -y