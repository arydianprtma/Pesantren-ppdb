# Troubleshooting 403 Forbidden di Production

## Masalah yang Terjadi
Error 403 Forbidden saat login di production environment.

## Penyebab Umum

### 1. File Permission yang Salah
**Gejala:** Server tidak bisa menulis ke storage atau cache
**Solusi:**
```bash
# Set permission yang benar
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Jika menggunakan user lain (contoh: nginx)
chown -R nginx:nginx storage bootstrap/cache
```

### 2. Konfigurasi .env yang Salah
**Gejala:** Session tidak tersimpan, CSRF token error
**Solusi:**
- Copy file `.env.production` ke `.env` di server production
- Update nilai berikut:
  ```env
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://domain-anda.com
  
  SESSION_DOMAIN=.domain-anda.com
  SESSION_SECURE_COOKIE=true
  
  DB_HOST=localhost
  DB_DATABASE=nama_database_production
  DB_USERNAME=user_database_production
  DB_PASSWORD=password_database_production
  ```

### 3. Missing .htaccess
**Gejala:** Routing tidak berfungsi, 404 atau 403 error
**Solusi:**
- Pastikan ada `.htaccess` di root project
- Pastikan ada `.htaccess` di folder `public`
- Pastikan mod_rewrite Apache sudah aktif

### 4. Trusted Proxies Issue
**Gejala:** 403 error saat di belakang reverse proxy (Nginx, Cloudflare, dll)
**Solusi:**
- Middleware `TrustProxies` sudah ditambahkan
- Jika masih error, cek konfigurasi proxy di server

### 5. CSRF Token Mismatch
**Gejala:** Error "CSRF token mismatch" atau 419
**Solusi:**
```bash
# Clear cache di production
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Checklist Deployment ke Production

### Sebelum Deploy:
- [ ] Build assets: `npm run build`
- [ ] Test di local dengan `APP_ENV=production`
- [ ] Pastikan semua migration sudah berjalan
- [ ] Backup database production

### Saat Deploy:
1. Upload semua file kecuali:
   - `.env` (buat baru di server)
   - `node_modules`
   - `vendor` (akan di-generate ulang)
   - `storage` (jangan overwrite yang ada di server)

2. Di server, jalankan:
```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate key jika belum ada
php artisan key:generate

# Run migrations
php artisan migrate --force

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Link storage
php artisan storage:link
```

### Setelah Deploy:
- [ ] Test login admin
- [ ] Test form registration
- [ ] Test upload file
- [ ] Cek error log: `storage/logs/laravel.log`

## Konfigurasi Web Server

### Apache (.htaccess sudah ada)
Pastikan mod_rewrite aktif:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Nginx
Jika menggunakan Nginx, tambahkan konfigurasi:
```nginx
server {
    listen 80;
    server_name domain-anda.com;
    root /path/to/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Debugging

### Cek Error Log
```bash
# Di server production
tail -f storage/logs/laravel.log
```

### Enable Debug Sementara (HATI-HATI!)
Jika perlu debug di production:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```
**INGAT:** Matikan lagi setelah selesai debugging!

### Test Permission
```bash
# Cek permission
ls -la storage/
ls -la bootstrap/cache/

# Cek owner
ls -la | grep storage
```

## Kontak Support
Jika masih mengalami masalah, hubungi:
- Developer: [email/contact]
- Server Admin: [email/contact]

## Catatan Penting
- Selalu backup database sebelum migration
- Jangan pernah set `APP_DEBUG=true` di production untuk waktu lama
- Monitor error log secara berkala
- Update dependencies secara berkala untuk security patches
