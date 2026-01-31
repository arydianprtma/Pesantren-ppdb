# Changelog - Fix 403 Forbidden Error

## Tanggal: 2026-02-01

### Masalah
User mengalami error **403 Forbidden** saat login di production environment.

### Penyebab Umum
1. File permission yang salah di server
2. Konfigurasi .env yang tidak sesuai untuk production
3. Missing .htaccess file
4. Trusted proxies tidak dikonfigurasi (jika di belakang reverse proxy)
5. CSRF token mismatch karena session configuration

### Perubahan yang Dilakukan

#### 1. File Baru yang Ditambahkan

##### a. `.htaccess` (Root Directory)
**Lokasi:** `/`
**Fungsi:** Redirect semua request ke folder `public/`
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

##### b. `.env.production` (Template Production)
**Lokasi:** `/`
**Fungsi:** Template konfigurasi untuk production environment
**Penting untuk diubah:**
- `APP_URL` → domain production Anda
- `DB_*` → kredensial database production
- `SESSION_DOMAIN` → domain Anda
- `MAIL_*` → konfigurasi email production

##### c. `TrustProxies.php` (Middleware)
**Lokasi:** `/app/Http/Middleware/TrustProxies.php`
**Fungsi:** Handle reverse proxy headers (Nginx, Cloudflare, load balancer)
**Mengapa penting:** Tanpa ini, aplikasi di belakang proxy akan mendapat IP dan protocol yang salah, menyebabkan 403 error

##### d. `DEPLOYMENT.md`
**Lokasi:** `/`
**Fungsi:** Panduan lengkap deployment ke production
**Isi:**
- Langkah-langkah deploy manual
- Cara menggunakan deployment script
- Troubleshooting 403 error
- Checklist setelah deploy
- Security checklist

##### e. `TROUBLESHOOTING_PRODUCTION.md`
**Lokasi:** `/`
**Fungsi:** Panduan troubleshooting lengkap untuk masalah production
**Isi:**
- Penyebab umum 403 error dan solusinya
- Debugging tips
- Konfigurasi web server (Apache & Nginx)
- Checklist deployment

##### f. `deploy.sh` (Bash Script)
**Lokasi:** `/`
**Fungsi:** Script otomatis untuk deployment di Linux server
**Cara pakai:**
```bash
chmod +x deploy.sh
./deploy.sh
```

##### g. `optimize-production.ps1` (PowerShell Script)
**Lokasi:** `/`
**Fungsi:** Script untuk clear cache dan optimize di Windows server
**Cara pakai:**
```powershell
.\optimize-production.ps1
```

##### h. `fix-403.sh` (Bash Script)
**Lokasi:** `/`
**Fungsi:** Quick fix untuk 403 error di Linux
**Cara pakai:**
```bash
chmod +x fix-403.sh
./fix-403.sh
```

##### i. `fix-403.ps1` (PowerShell Script)
**Lokasi:** `/`
**Fungsi:** Quick fix untuk 403 error di Windows
**Cara pakai:**
```powershell
.\fix-403.ps1
```

#### 2. File yang Dimodifikasi

##### a. `bootstrap/app.php`
**Perubahan:** Menambahkan TrustProxies middleware
**Sebelum:**
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        \App\Http\Middleware\HandleInertiaRequests::class,
    ]);
})
```

**Sesudah:**
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        \App\Http\Middleware\HandleInertiaRequests::class,
    ]);
    
    // Trust proxies for production environment
    $middleware->trustProxies(at: [
        \App\Http\Middleware\TrustProxies::class,
    ]);
})
```

##### b. `app/Providers/Filament/PortalPanelProvider.php`
**Perubahan:** Menambahkan TrustProxies ke Filament middleware
**Sebelum:**
```php
->middleware([
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    // ... other middlewares
])
```

**Sesudah:**
```php
->middleware([
    \App\Http\Middleware\TrustProxies::class,
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    // ... other middlewares
])
```

### Cara Menggunakan di Production

#### Opsi 1: Quick Fix (Jika sudah deploy)
Jika aplikasi sudah di-deploy dan mengalami 403 error:

**Linux:**
```bash
chmod +x fix-403.sh
./fix-403.sh
```

**Windows:**
```powershell
.\fix-403.ps1
```

#### Opsi 2: Deploy Baru
Jika belum deploy atau ingin deploy ulang:

1. **Persiapan:**
   ```bash
   npm run build
   ```

2. **Upload files** (kecuali: `.env`, `node_modules`, `vendor`, `storage`)

3. **Di server:**
   ```bash
   # Copy template .env
   cp .env.production .env
   
   # Edit .env sesuai production
   nano .env
   
   # Jalankan deployment script
   chmod +x deploy.sh
   ./deploy.sh
   ```

### Konfigurasi yang Harus Diubah di Production

#### File `.env`
```env
# WAJIB DIUBAH:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

# Database production
DB_HOST=localhost
DB_DATABASE=nama_database_production
DB_USERNAME=user_database_production
DB_PASSWORD=password_database_production

# Session (penting untuk CSRF)
SESSION_DOMAIN=.domain-anda.com
SESSION_SECURE_COOKIE=true

# Email (jika ada)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@domain.com
MAIL_PASSWORD=app_password
```

### Testing Setelah Deploy

1. **Test login admin:**
   - URL: `https://domain-anda.com/portal/login`
   - Email: `admin@riyadussalikin.sch.id`
   - Password: `admin123`

2. **Test form PPDB:**
   - Buka halaman home
   - Coba akses form pendaftaran
   - Test upload file

3. **Cek error log:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

### Troubleshooting

Jika masih mengalami 403 error setelah mengikuti langkah di atas:

1. **Cek file permission:**
   ```bash
   ls -la storage/
   ls -la bootstrap/cache/
   ```
   Harus: `drwxrwxr-x` (775)

2. **Cek owner:**
   ```bash
   ls -la | grep storage
   ```
   Harus: `www-data` atau user web server Anda

3. **Cek .htaccess:**
   - Pastikan ada di root dan di `public/`
   - Pastikan mod_rewrite Apache aktif

4. **Cek APP_URL:**
   - Harus sesuai dengan domain production
   - Harus menggunakan HTTPS jika SSL aktif

5. **Clear cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

### Catatan Penting

⚠️ **JANGAN LUPA:**
1. Backup database sebelum migration
2. Ganti password admin setelah login pertama
3. Set `APP_DEBUG=false` di production
4. Pastikan SSL/HTTPS sudah aktif
5. Monitor error log secara berkala

### Referensi Dokumentasi

- `DEPLOYMENT.md` - Panduan deployment lengkap
- `TROUBLESHOOTING_PRODUCTION.md` - Troubleshooting guide
- `fix-403.sh` / `fix-403.ps1` - Quick fix script
- `deploy.sh` - Deployment automation script

### Kontak Support

Jika masih mengalami masalah setelah mengikuti semua langkah di atas, silakan hubungi developer dengan informasi berikut:
- Screenshot error
- Isi file `storage/logs/laravel.log` (10 baris terakhir)
- Konfigurasi server (Apache/Nginx, PHP version, dll)
