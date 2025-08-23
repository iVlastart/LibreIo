# Stage 1: Build frontend
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP / Laravel
FROM php:8.2-fpm
WORKDIR /var/www

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app code
COPY . .

# Copy frontend build output
COPY --from=frontend /app/public/build ./public/build
COPY --from=frontend /app/node_modules ./node_modules

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Clear caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
CMD ["/entrypoint.sh"]
