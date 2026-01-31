# Script untuk clear cache dan optimize Laravel
# Jalankan script ini di server production (Windows)

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "Laravel Cache Clear & Optimize" -ForegroundColor Cyan
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

function Print-Success {
    param([string]$message)
    Write-Host "✓ $message" -ForegroundColor Green
}

function Print-Error {
    param([string]$message)
    Write-Host "✗ $message" -ForegroundColor Red
}

function Print-Warning {
    param([string]$message)
    Write-Host "⚠ $message" -ForegroundColor Yellow
}

# Cek apakah di direktori Laravel
if (-not (Test-Path "artisan")) {
    Print-Error "File artisan tidak ditemukan!"
    Print-Warning "Pastikan Anda menjalankan script ini di root directory Laravel"
    exit 1
}

Print-Success "File artisan ditemukan"

# Clear all caches
Write-Host ""
Write-Host "Clearing all caches..." -ForegroundColor Yellow

try {
    php artisan config:clear
    Print-Success "Config cache cleared"
    
    php artisan cache:clear
    Print-Success "Application cache cleared"
    
    php artisan route:clear
    Print-Success "Route cache cleared"
    
    php artisan view:clear
    Print-Success "View cache cleared"
} catch {
    Print-Error "Gagal clear cache: $_"
    exit 1
}

# Optimize for production
Write-Host ""
Write-Host "Optimizing for production..." -ForegroundColor Yellow

try {
    php artisan config:cache
    Print-Success "Config cached"
    
    php artisan route:cache
    Print-Success "Routes cached"
    
    php artisan view:cache
    Print-Success "Views cached"
} catch {
    Print-Error "Gagal optimize: $_"
    exit 1
}

# Create storage link if not exists
Write-Host ""
Write-Host "Creating storage link..." -ForegroundColor Yellow

try {
    php artisan storage:link
    Print-Success "Storage link created"
} catch {
    Print-Warning "Storage link mungkin sudah ada"
}

Write-Host ""
Write-Host "===================================" -ForegroundColor Cyan
Print-Success "Process completed!"
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

Print-Warning "Catatan:"
Write-Host "  1. Pastikan APP_ENV=production di .env"
Write-Host "  2. Pastikan APP_DEBUG=false di .env"
Write-Host "  3. Cek error log di storage/logs/laravel.log"
Write-Host ""
