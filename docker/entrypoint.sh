#!/bin/bash
set -e

cd /var/www/html

# Install composer dependencies (jika belum)
if [ ! -d "vendor" ]; then
    echo "📦 Installing composer dependencies..."
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# Generate app key jika belum ada
php artisan key:generate --no-interaction --force 2>/dev/null || true

# Buat file SQLite database jika belum ada
if [ ! -f "database/database.sqlite" ]; then
    echo "🗄️  Creating SQLite database..."
    touch database/database.sqlite
fi

# Ensure SQLite database file and directory are writable by the web server
chmod 777 database
chmod 666 database/database.sqlite


# Jalankan migrasi
echo "🔄 Running migrations..."
php artisan migrate --force --no-interaction 2>/dev/null || true

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Recreate storage symlink
echo "🔗 Recreating storage symlink..."
rm -f public/storage
php artisan storage:link --relative --no-interaction 2>/dev/null || true


# Clear & cache config
php artisan config:cache --no-interaction 2>/dev/null || true
php artisan route:cache --no-interaction 2>/dev/null || true
php artisan view:cache --no-interaction 2>/dev/null || true

echo "✅ Webku app ready! Starting services..."

# Start supervisord (nginx + php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
