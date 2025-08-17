#!/bin/bash
set -e

# Ensure DB folder exists
mkdir -p /var/www/database

# Create SQLite file if it doesn't exist
if [ ! -f /var/www/database/database.sqlite ]; then
    touch /var/www/database/database.sqlite
fi

# Set permissions
chmod -R 777 /var/www/database

# Run migrations
php artisan migrate --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=10000
