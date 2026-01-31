#!/bin/bash

# Quick Fix untuk 403 Forbidden Error
# Jalankan script ini di server production saat mengalami 403 error

echo "========================================"
echo "Quick Fix: 403 Forbidden Error"
echo "========================================"
echo ""

# Warna
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

# 1. Clear all caches
echo "Step 1: Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
print_success "Caches cleared"

# 2. Fix permissions
echo ""
echo "Step 2: Fixing permissions..."
chmod -R 775 storage bootstrap/cache
print_success "Permissions fixed"

# 3. Recreate cache
echo ""
echo "Step 3: Recreating cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_success "Cache recreated"

# 4. Check .env
echo ""
echo "Step 4: Checking .env configuration..."
if grep -q "APP_ENV=production" .env; then
    print_success "APP_ENV is set to production"
else
    print_warning "APP_ENV is not set to production!"
fi

if grep -q "APP_DEBUG=false" .env; then
    print_success "APP_DEBUG is set to false"
else
    print_warning "APP_DEBUG should be false in production!"
fi

# 5. Check APP_URL
echo ""
echo "Step 5: Checking APP_URL..."
app_url=$(grep "APP_URL=" .env | cut -d '=' -f2)
if [[ $app_url == *"localhost"* ]] || [[ $app_url == *"127.0.0.1"* ]]; then
    print_error "APP_URL is still set to localhost!"
    print_warning "Please update APP_URL in .env to your production domain"
else
    print_success "APP_URL looks good: $app_url"
fi

# 6. Check storage link
echo ""
echo "Step 6: Checking storage link..."
if [ -L "public/storage" ]; then
    print_success "Storage link exists"
else
    print_warning "Storage link not found, creating..."
    php artisan storage:link
    print_success "Storage link created"
fi

# 7. Check .htaccess
echo ""
echo "Step 7: Checking .htaccess files..."
if [ -f "public/.htaccess" ]; then
    print_success "public/.htaccess exists"
else
    print_error "public/.htaccess is missing!"
fi

if [ -f ".htaccess" ]; then
    print_success "Root .htaccess exists"
else
    print_warning "Root .htaccess not found (might be okay depending on server config)"
fi

echo ""
echo "========================================"
print_success "Quick fix completed!"
echo "========================================"
echo ""

print_warning "Next steps:"
echo "  1. Test login: /portal/login"
echo "  2. Check error log: tail -f storage/logs/laravel.log"
echo "  3. If still error, check TROUBLESHOOTING_PRODUCTION.md"
echo ""

# Optional: Show last 10 lines of error log
if [ -f "storage/logs/laravel.log" ]; then
    echo "Last 10 lines of error log:"
    echo "----------------------------"
    tail -n 10 storage/logs/laravel.log
fi
