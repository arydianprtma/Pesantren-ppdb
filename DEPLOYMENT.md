# Panduan Deploy ke Production

## 📋 Persiapan Sebelum Deploy

### 1. Build Assets
```bash
npm install
npm run build
```

### 2. Test di Local dengan Production Mode
```bash
# Ubah .env sementara
APP_ENV=production
APP_DEBUG=false

# Clear cache
php artisan config:clear
php artisan cache:clear

# Test aplikasi
php artisan serve
```

### 3. Backup Database Production
```bash
# Di server production
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
```

## 🚀 Langkah-langkah Deploy

### Opsi 1: Deploy Manual

#### A. Upload Files
Upload semua file **KECUALI**:
- `.env` (buat baru di server)
- `node_modules/`
- `vendor/` (akan di-generate ulang)
- `storage/` (jangan overwrite yang ada di server)
- `.git/`

#### B. Setup di Server

1. **Copy dan edit file .env**
```bash
cp .env.production .env
nano .env
```

Edit nilai berikut:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

DB_HOST=localhost
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database

SESSION_DOMAIN=.domain-anda.com
SESSION_SECURE_COOKIE=true
```

2. **Install Dependencies**
```bash
composer install --optimize-autoloader --no-dev
```

3. **Generate Application Key** (jika belum ada)
```bash
php artisan key:generate
```

4. **Run Migrations**
```bash
php artisan migrate --force
```

5. **Seed Admin User** (jika database baru)
```bash
php artisan db:seed --class=UserSeeder
```

6. **Optimize untuk Production**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

7. **Create Storage Link**
```bash
php artisan storage:link
```

8. **Set Permissions**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Opsi 2: Deploy dengan Script

```bash
# Upload semua file termasuk deploy.sh
chmod +x deploy.sh
./deploy.sh
```

## 🔧 Troubleshooting 403 Forbidden

### Penyebab #1: File Permission
```bash
# Cek permission
ls -la storage/
ls -la bootstrap/cache/

# Fix permission
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Penyebab #2: Session/CSRF Issue
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize ulang
php artisan config:cache
php artisan route:cache
```

### Penyebab #3: .htaccess Missing
Pastikan ada 2 file `.htaccess`:
- Di root project: untuk redirect ke `public/`
- Di folder `public/`: untuk Laravel routing

### Penyebab #4: Proxy Issue
Jika di belakang reverse proxy (Nginx, Cloudflare):
- Middleware `TrustProxies` sudah ditambahkan
- Pastikan proxy headers diteruskan dengan benar

### Penyebab #5: APP_URL Salah
```env
# Pastikan APP_URL sesuai dengan domain production
APP_URL=https://domain-anda.com

# Bukan:
# APP_URL=http://localhost
# APP_URL=http://127.0.0.1:8000
```

## 🔍 Debugging

### Cek Error Log
```bash
tail -f storage/logs/laravel.log
```

### Enable Debug Sementara (HATI-HATI!)
```env
APP_DEBUG=true
LOG_LEVEL=debug
```
**⚠️ INGAT:** Matikan lagi setelah selesai debugging!

### Test Permission
```bash
# Test write ke storage
touch storage/test.txt
rm storage/test.txt

# Jika gagal, ada masalah permission
```

## 📝 Checklist Setelah Deploy

- [ ] Login admin berhasil (`/portal/login`)
- [ ] Dashboard admin tampil dengan benar
- [ ] Form PPDB bisa diakses
- [ ] Upload file berfungsi
- [ ] Email notification berfungsi (jika ada)
- [ ] Semua halaman public bisa diakses
- [ ] Tidak ada error di log

## 🔐 Kredensial Default

**Admin Login:**
- Email: `admin@riyadussalikin.sch.id`
- Password: `admin123`

**⚠️ PENTING:** Ganti password admin setelah login pertama kali!

## 📞 Bantuan

Jika masih mengalami masalah, cek file:
- `TROUBLESHOOTING_PRODUCTION.md` - Panduan lengkap troubleshooting
- `storage/logs/laravel.log` - Error log aplikasi

## 🔄 Update Aplikasi

Untuk update aplikasi di production:

1. Backup database terlebih dahulu
2. Upload file yang berubah
3. Jalankan:
```bash
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🛡️ Security Checklist

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Password admin sudah diganti
- [ ] SSL/HTTPS sudah aktif
- [ ] File permission sudah benar (775, bukan 777)
- [ ] `.env` tidak bisa diakses dari browser
- [ ] Error log tidak menampilkan informasi sensitif

---

**Catatan:** Selalu backup database sebelum melakukan perubahan di production!
