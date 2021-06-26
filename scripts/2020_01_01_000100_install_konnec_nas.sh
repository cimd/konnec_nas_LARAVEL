#!/bin/bash

# Create Database
echo "Creating Database"
sudo mysql -u root -e "create database konnec_nas; \
grant all privileges on konnec_nas.* to admin@localhost identified by 'admin'; \
flush privileges; \
exit;"

# Install Laravel
echo "Installing Konnec NAS"
sudo cp -r ~/konnec_nas /var/www/
# mkdir /var/www/konnec_nas/storage/framework/sessions /var/www/konnec_nas/storage/framework/views /var/www/konnec_nas/storage/framework/cache
sudo chmod -R 777 /var/www/konnec_nas/storage
sudo composer install --optimize-autoloader --no-dev --working-dir=/var/www/konnec_nas
# ln -s /home/$USER/konnec_nas/public/storage /home/$USER/konnec_nas/storage/app/electron/Packaged
# mariadb -u root -p   /var/www/konnec_nas/database-setup.sql
sudo cp /var/www/konnec_nas/PROD.env /var/www/konnec_nas/.env
sudo php /var/www/konnec_nas/artisan migrate
sudo php /var/www/konnec_nas/artisan config:cache
sudo php /var/www/konnec_nas/artisan route:cache
sudo php /var/www/konnec_nas/artisan view:cache
sudo php /var/www/konnec_nas/artisan event:cache

#Supervisor
echo "Configuring Supervisor"
sudo cp /var/www/konnec_nas/laravel-worker.conf /etc/supervisor/conf.d
# sudo cp /var/www/konnec_nas/echo-server-worker.conf /etc/supervisor/conf.d
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
# sudo supervisorctl start echo-server-worker:*