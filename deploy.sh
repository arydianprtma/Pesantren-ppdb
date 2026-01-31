#!/bin/bash

# Script untuk deploy ke production
# Jalankan script ini di server production

echo "==================================="
echo "Laravel Production Deployment"
echo "==================================="
echo ""

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function untuk print dengan warna
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

# Cek apakah .env ada
if [ ! -f .env ]; then
    print_error ".env file tidak ditemukan!"
    print_warning "Silakan copy .env.production ke .env dan sesuaikan konfigurasinya"
    exit 1
fi

print_success ".env file ditemukan"

# Install composer dependencies
echo ""
echo "Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev
if [ $? -eq 0 ]; then
    print_success "Composer dependencies installed"
else
    print_error "Gagal install composer dependencies"
    exit 1
fi

# Generate application key jika belum ada
if grep -q "APP_KEY=$" .env; then
    echo ""
    echo "Generating application key..."
    php artisan key:generate
    print_success "Application key generated"
fi

# Run migrations
echo ""
echo "Running database migrations..."
read -p "Apakah Anda yakin ingin menjalankan migrations? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    if [ $? -eq 0 ]; then
        print_success "Migrations completed"
    else
        print_error "Migrations failed"
        exit 1
    fi
else
    print_warning "Migrations skipped"
fi

# Clear all caches
echo ""
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
print_success "Caches cleared"

# Optimize for production
echo ""
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_success "Application optimized"

# Create storage link
echo ""
echo "Creating storage link..."
php artisan storage:link
print_success "Storage link created"

# Set permissions
echo ""
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
print_success "Permissions set"

# Cek owner (optional, uncomment jika diperlukan)
# echo ""
# echo "Setting owner..."
# read -p "Enter web server user (default: www-data): " webuser
# webuser=${webuser:-www-data}
# chown -R $webuser:$webuser storage bootstrap/cache
# print_success "Owner set to $webuser"

echo ""
echo "==================================="
print_success "Deployment completed!"
echo "==================================="
echo ""
print_warning "Jangan lupa untuk:"
echo "  1. Cek error log: tail -f storage/logs/laravel.log"
echo "  2. Test login admin"
echo "  3. Test semua fitur penting"
echo "  4. Set APP_DEBUG=false di .env"
echo ""
