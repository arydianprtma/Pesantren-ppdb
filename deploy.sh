#!/bin/bash

# Pastikan skrip berhenti jika ada kesalahan
set -e

echo "🚀 Memulai proses deployment..."

# Masuk ke mode maintenance
php artisan down || true

# Update kode dari repositori (Opsional, jika menggunakan git)
# git pull origin main

# Install dependensi PHP
echo "📦 Menginstall dependensi Composer..."
composer install --no-dev --optimize-autoloader --no-interaction

# Jalankan migrasi database
echo "🗄️ Menjalankan migrasi database..."
php artisan migrate --force

# Cache konfigurasi dan route untuk performa
echo "⚡ Mengoptimalkan aplikasi..."
php artisan optimize
php artisan view:cache
php artisan event:cache

# Install dan build aset frontend (Inertia/Vue)
echo "🎨 Membangun aset frontend..."
npm install
npm run build

# Keluar dari mode maintenance
php artisan up

echo "✅ Deployment selesai dengan sukses!"
