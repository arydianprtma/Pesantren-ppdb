#!/bin/bash
set -e

echo "🚀 Inisialisasi Kontainer Pesantren PPDB..."

DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_USER="${DB_USERNAME:-root}"
DB_PASS="${DB_PASSWORD:-}"

# Tunggu database MySQL siap
echo "⏳ Menunggu database ($DB_HOST:$DB_PORT) siap menerima koneksi..."
while ! mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" --silent; do
    sleep 2
done
echo "✅ Database terhubung!"

# ─────────────────────────────────────────────
# Inisialisasi Proyek Utama (Website & Admin)
# ─────────────────────────────────────────────
cd /var/www/pesantren-ppdb

echo "📁 Menyiapkan direktori storage & cache (Aplikasi Utama)..."
mkdir -p storage/framework/{sessions,views,cache/data} storage/app/public storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ ! -f .env ]; then
    if [ -f .env.production ]; then
        cp .env.production .env
    else
        cp .env.example .env
    fi
fi

echo "📦 Menginstall dependensi Composer (Aplikasi Utama)..."
composer install --no-dev --optimize-autoloader --no-interaction

if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    echo "🔑 Menghasilkan APP_KEY (Aplikasi Utama)..."
    php artisan key:generate --force
fi

echo "🗄️ Menjalankan migrasi database..."
php artisan migrate --force

echo "🔗 Membuat storage symlink..."
php artisan storage:link || true

if [ ! -d "public/build" ]; then
    echo "🎨 Membangun frontend assets (Vite)..."
    npm install
    npm run build
fi

echo "⚡ Mengoptimalkan cache aplikasi..."
php artisan optimize --except=views || true

# ─────────────────────────────────────────────
# Inisialisasi Submodul PPDB
# ─────────────────────────────────────────────
if [ -d "/var/www/pesantren-ppdb/PPDB" ]; then
    echo "🚀 Inisialisasi Submodul PPDB..."
    cd /var/www/pesantren-ppdb/PPDB

    echo "📁 Menyiapkan direktori storage & cache (PPDB)..."
    mkdir -p storage/framework/{sessions,views,cache/data} storage/app/public storage/app/private storage/logs bootstrap/cache
    chmod -R 775 storage bootstrap/cache

    if [ ! -f .env ]; then
        if [ -f .env.production ]; then
            cp .env.production .env
        elif [ -f .env.example ]; then
            cp .env.example .env
        fi
        sed -i "s/DB_HOST=127.0.0.1/DB_HOST=${DB_HOST}/" .env || true
        sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env || true
    fi

    echo "📦 Menginstall dependensi Composer (PPDB)..."
    composer install --no-dev --optimize-autoloader --no-interaction

    if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
        echo "🔑 Menghasilkan APP_KEY (PPDB)..."
        php artisan key:generate --force
    fi

    echo "🔗 Membuat storage symlink PPDB..."
    php artisan storage:link || true

    if [ ! -d "public/build" ]; then
        echo "🎨 Membangun frontend assets PPDB (Vite)..."
        npm install
        npm run build
    fi

    echo "⚡ Mengoptimalkan cache PPDB..."
    php artisan optimize --except=views || true
    cd /var/www/pesantren-ppdb
fi

# Set kepemilikan direktori storage dan cache
chown -R www-data:www-data /var/www/pesantren-ppdb/storage /var/www/pesantren-ppdb/bootstrap/cache
if [ -d "/var/www/pesantren-ppdb/PPDB" ]; then
    chown -R www-data:www-data /var/www/pesantren-ppdb/PPDB/storage /var/www/pesantren-ppdb/PPDB/bootstrap/cache
fi

echo "🎉 Inisialisasi selesai, menjalankan Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
