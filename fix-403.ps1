# Quick Fix untuk 403 Forbidden Error (Windows)
# Jalankan script ini di server production Windows saat mengalami 403 error

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Quick Fix: 403 Forbidden Error" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
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

# 1. Clear all caches
Write-Host "Step 1: Clearing all caches..." -ForegroundColor Yellow
try {
    php artisan config:clear | Out-Null
    php artisan cache:clear | Out-Null
    php artisan route:clear | Out-Null
    php artisan view:clear | Out-Null
    Print-Success "Caches cleared"
} catch {
    Print-Error "Failed to clear caches: $_"
}

# 2. Recreate cache
Write-Host ""
Write-Host "Step 2: Recreating cache..." -ForegroundColor Yellow
try {
    php artisan config:cache | Out-Null
    php artisan route:cache | Out-Null
    php artisan view:cache | Out-Null
    Print-Success "Cache recreated"
} catch {
    Print-Error "Failed to recreate cache: $_"
}

# 3. Check .env
Write-Host ""
Write-Host "Step 3: Checking .env configuration..." -ForegroundColor Yellow

if (Test-Path ".env") {
    $envContent = Get-Content ".env" -Raw
    
    if ($envContent -match "APP_ENV=production") {
        Print-Success "APP_ENV is set to production"
    } else {
        Print-Warning "APP_ENV is not set to production!"
    }
    
    if ($envContent -match "APP_DEBUG=false") {
        Print-Success "APP_DEBUG is set to false"
    } else {
        Print-Warning "APP_DEBUG should be false in production!"
    }
    
    # Check APP_URL
    if ($envContent -match "APP_URL=(.+)") {
        $appUrl = $matches[1]
        if ($appUrl -match "localhost|127\.0\.0\.1") {
            Print-Error "APP_URL is still set to localhost!"
            Print-Warning "Please update APP_URL in .env to your production domain"
        } else {
            Print-Success "APP_URL looks good: $appUrl"
        }
    }
} else {
    Print-Error ".env file not found!"
}

# 4. Check storage link
Write-Host ""
Write-Host "Step 4: Checking storage link..." -ForegroundColor Yellow
if (Test-Path "public\storage") {
    Print-Success "Storage link exists"
} else {
    Print-Warning "Storage link not found, creating..."
    try {
        php artisan storage:link | Out-Null
        Print-Success "Storage link created"
    } catch {
        Print-Error "Failed to create storage link: $_"
    }
}

# 5. Check .htaccess
Write-Host ""
Write-Host "Step 5: Checking .htaccess files..." -ForegroundColor Yellow
if (Test-Path "public\.htaccess") {
    Print-Success "public\.htaccess exists"
} else {
    Print-Error "public\.htaccess is missing!"
}

if (Test-Path ".htaccess") {
    Print-Success "Root .htaccess exists"
} else {
    Print-Warning "Root .htaccess not found (might be okay depending on server config)"
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Print-Success "Quick fix completed!"
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Print-Warning "Next steps:"
Write-Host "  1. Test login: /portal/login"
Write-Host "  2. Check error log: storage\logs\laravel.log"
Write-Host "  3. If still error, check TROUBLESHOOTING_PRODUCTION.md"
Write-Host ""

# Show last 10 lines of error log if exists
if (Test-Path "storage\logs\laravel.log") {
    Write-Host "Last 10 lines of error log:" -ForegroundColor Yellow
    Write-Host "----------------------------" -ForegroundColor Yellow
    Get-Content "storage\logs\laravel.log" -Tail 10
}
