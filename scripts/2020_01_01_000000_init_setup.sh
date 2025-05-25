#!/bin/bash

#Ubuntu Deployment
echo "Ubuntu Updates"
sudo apt update
sudo apt -y upgrade
sudo apt install curl ca-certificates apt-transport-https software-properties-common \
gnupg lsb-release unzip smbclient \
git -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
