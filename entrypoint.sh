#!/bin/bash
set -e

# Run migrations first
php artisan migrate --force

# Clear caches safely
php artisan config:clear
php artisan cache:clear || true  # Ignore error if cache table doesn't exist yet
php artisan route:clear
php artisan view:clear

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
