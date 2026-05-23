FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    zip unzip nginx supervisor libzip-dev libsqlite3-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (SQLite karena webku pakai SQLite)
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy config files
COPY docker/nginx.conf      /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh   /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
