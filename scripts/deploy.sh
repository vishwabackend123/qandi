#!/bin/bash
cd /var/www/html/uniq
npm run dev
composer dump-autoload
php artisan optimize:clear
php artisan view:clear
sudo systemctl restart php7.4-fpm.service