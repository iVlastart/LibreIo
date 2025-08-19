#!/bin/bash
set -e

# Ensure database folder and file exist
mkdir -p /var/www/database
if [ ! -f /var/www/database/database.sqlite ]; then
    touch /var/www/database/database.sqlite
fi
chmod -R 777 /var/www/database

# Run migrations first
php artisan migrate --force

# Clear caches safely
php artisan config:clear
php artisan cache:clear || true  # Ignore error if cache table doesn't exist yet
php artisan route:clear
php artisan view:clear

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
