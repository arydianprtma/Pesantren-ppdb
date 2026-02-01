# Website Pondok Pesantren Riyadussalikin Padaherang

Website profil resmi Pondok Pesantren Riyadussalikin Padaherang yang dibangun dengan Laravel 12, Inertia.js (Vue 3), dan Tailwind CSS.

## 🎯 Fitur Utama

### Website Publik
- **Beranda**: Hero section dengan logo, slogan islami, keunggulan pesantren, dan preview prestasi terbaru
- **Visi & Misi**: Menampilkan visi, misi, dan nilai-nilai pesantren
- **Prestasi**: Daftar prestasi santri dengan filter kategori (Akademik, Non-Akademik, Keagamaan) dan tahun
- **Kontak**: Informasi kontak lengkap, Google Maps, dan form kontak publik
- **Tombol PPDB**: Selalu terlihat di navbar, mengarah ke website PPDB eksternal

### Dashboard Admin (Filament)
Dashboard admin sudah tersedia dengan fitur:
- **Portal Admin**: Akses di `/portal/login`
- **Manajemen PPDB**: Kelola pendaftaran santri baru
- **Manajemen Prestasi**: Tambah, edit, hapus data prestasi
- **Manajemen Pesan**: Lihat pesan kontak dari form publik
- **Widgets**: Real-time clock, statistik PPDB terbaru
- **Notifikasi**: Database notifications untuk aktivitas penting
- **Sistem Autentikasi**: Login admin dengan email dan password

## 🎨 Desain

- **Warna Utama**: Hijau Emerald (#10b981) - diambil dari logo pesantren
- **Warna Pendukung**: Putih (background) dan Kuning/Emas lembut (aksen)
- **Font**: Inter (sans-serif) dan Amiri (Arabic/Islamic)
- **Responsif**: Mobile-first design, optimal di semua perangkat

## 📋 Prasyarat

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laragon (recommended untuk Windows)

## 🚀 Instalasi

### 1. Clone atau Extract Project

```bash
cd c:\laragon\www\PesantrenPPDB
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Setup Environment

File `.env` sudah dikonfigurasi untuk MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pesantren_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database

Buat database baru bernama `pesantren_db` di phpMyAdmin atau MySQL:

```sql
CREATE DATABASE pesantren_db;
```

### 5. Jalankan Migration & Seeder

```bash
php artisan migrate:fresh --seed
```

Ini akan membuat tabel dan mengisi data dummy prestasi.

### 6. Build Assets

```bash
npm run build
```

Atau untuk development dengan hot reload:

```bash
npm run dev
```

### 7. Jalankan Server

```bash
php artisan serve
```

Website akan berjalan di: **http://localhost:8000**

## 📁 Struktur Project

```
PesantrenPPDB/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── PrestasiController.php
│   │   │   └── ContactController.php
│   │   └── Middleware/
│   │       └── HandleInertiaRequests.php
│   └── Models/
│       ├── Prestasi.php
│       └── ContactMessage.php
├── database/
│   ├── migrations/
│   │   ├── *_create_prestasis_table.php
│   │   └── *_create_contact_messages_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PrestasiSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css (Tailwind + Custom Styles)
│   ├── js/
│   │   ├── app.js (Inertia Setup)
│   │   ├── Layouts/
│   │   │   └── MainLayout.vue
│   │   └── Pages/
│   │       ├── Home.vue
│   │       ├── VisiMisi.vue
│   │       ├── Prestasi.vue
│   │       └── Contact.vue
│   └── views/
│       └── app.blade.php (Root Template)
├── public/
│   └── logo.png
└── routes/
    └── web.php
```

## 🎯 Halaman Website

### 1. Beranda (/)
- Hero section dengan logo dan slogan
- Keunggulan pesantren (3 card)
- Preview 6 prestasi terbaru
- Call-to-action PPDB

### 2. Visi & Misi (/visi-misi)
- Visi pesantren
- 5 Misi utama
- 4 Nilai-nilai pesantren (Ikhlas, Ilmu, Ukhuwah, Amanah)

### 3. Prestasi (/prestasi)
- Filter berdasarkan kategori dan tahun
- Prestasi dikelompokkan per kategori
- Data dinamis dari database

### 4. Kontak (/kontak)
- Informasi kontak (Alamat, WhatsApp, Email)
- Google Maps embed
- Form kontak (Nama, WhatsApp, Pesan)
- Pesan tersimpan ke database

## 🔧 Kustomisasi

### Mengubah Informasi Kontak

Edit file `resources/js/Layouts/MainLayout.vue` dan `resources/js/Pages/Contact.vue`:

```vue
// Alamat
<p>Jl. Raya Padaherang No. 123<br>Padaherang, Pangandaran<br>Jawa Barat 46396</p>

// WhatsApp
<a href="https://wa.me/6281234567890">+62 812-3456-7890</a>

// Email
<a href="mailto:info@riyadussalikin.sch.id">info@riyadussalikin.sch.id</a>
```

### Mengubah Link PPDB

Edit file `resources/js/Layouts/MainLayout.vue`:

```vue
<a href="https://ppdb.riyadussalikin.sch.id" target="_blank">
    PPDB
</a>
```

### Menambah Data Prestasi

Gunakan seeder atau tambahkan manual via database:

```php
// database/seeders/PrestasiSeeder.php
Prestasi::create([
    'judul' => 'Judul Prestasi',
    'kategori' => 'akademik', // atau 'non_akademik', 'keagamaan'
    'tingkat' => 'Nasional',
    'tahun' => 2024,
    'deskripsi' => 'Deskripsi prestasi...',
]);
```

### Mengubah Warna

Edit file `resources/css/app.css`:

```css
/* Emerald Green - Primary Color */
--color-primary-500: #10b981; /* Ubah sesuai kebutuhan */

/* Gold/Yellow Accent */
--color-accent-500: #eab308; /* Ubah sesuai kebutuhan */
```

## 📱 Testing

### Test Halaman Publik

1. Buka http://localhost:8000 - Halaman Beranda
2. Klik menu "Visi & Misi" - Halaman Visi & Misi
3. Klik menu "Prestasi" - Halaman Prestasi dengan filter
4. Klik menu "Kontak" - Halaman Kontak dengan form
5. Test form kontak - Isi dan kirim pesan
6. Cek database tabel `contact_messages` - Pesan harus tersimpan

### Test Responsiveness

1. Buka DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Test di berbagai ukuran:
   - Mobile (375px)
   - Tablet (768px)
   - Desktop (1024px+)

## 🐛 Troubleshooting

### Error "SQLSTATE[HY000] [1049] Unknown database"

Pastikan database `pesantren_db` sudah dibuat di MySQL.

### Error "Vite manifest not found"

Jalankan `npm run build` untuk build assets.

### Halaman blank/error 500

1. Clear cache: `php artisan cache:clear`
2. Clear config: `php artisan config:clear`
3. Clear route: `php artisan route:clear`
4. Regenerate autoload: `composer dump-autoload`

### Logo tidak muncul

Pastikan file `public/logo.png` ada. Jika tidak, copy logo dari folder assets.

## 📝 Catatan Penting

1. **Data Dummy**: Data prestasi yang ada adalah contoh. Hapus dan ganti dengan data real.
2. **Google Maps**: Update koordinat di `resources/js/Pages/Contact.vue` sesuai lokasi real pesantren.
3. **WhatsApp**: Update nomor WhatsApp di seluruh file dengan nomor real.
4. **Email**: Update email di seluruh file dengan email real.
5. **Link PPDB**: Update link PPDB dengan URL real website PPDB Anda.

## 🚀 Production Deployment

### Quick Start

Untuk deploy ke production server, ikuti langkah berikut:

1. **Build assets:**
   ```bash
   npm run build
   ```

2. **Upload files** (kecuali: `.env`, `node_modules`, `vendor`, `storage`)

3. **Di server production:**
   ```bash
   # Copy template .env
   cp .env.production .env
   
   # Edit .env sesuai production
   nano .env
   
   # Jalankan deployment script
   chmod +x deploy.sh
   ./deploy.sh
   ```

### Troubleshooting 403 Forbidden Error

Jika mengalami **403 Forbidden** saat login di production:

**Quick Fix (Linux):**
```bash
chmod +x fix-403.sh
./fix-403.sh
```

**Quick Fix (Windows):**
```powershell
.\fix-403.ps1
```

### Dokumentasi Lengkap

Untuk panduan deployment dan troubleshooting yang lebih detail, lihat:

- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Panduan deployment step-by-step
- **[TROUBLESHOOTING_PRODUCTION.md](TROUBLESHOOTING_PRODUCTION.md)** - Troubleshooting guide lengkap
- **[CHANGELOG_403_FIX.md](CHANGELOG_403_FIX.md)** - Dokumentasi fix 403 error

### Kredensial Admin Default

- **Email:** `admin@riyadussalikin.sch.id`
- **Password:** `admin123`

⚠️ **PENTING:** Ganti password admin setelah login pertama kali!

### Scripts yang Tersedia

- `deploy.sh` - Deployment automation (Linux)
- `fix-403.sh` - Quick fix 403 error (Linux)
- `fix-403.ps1` - Quick fix 403 error (Windows)
- `optimize-production.ps1` - Cache optimization (Windows)

## 🔐 Keamanan

Untuk production:

1. Set `APP_DEBUG=false` di `.env`
2. Generate APP_KEY baru: `php artisan key:generate`
3. Gunakan HTTPS
4. Setup CORS jika diperlukan
5. Tambahkan rate limiting untuk form kontak

## 📞 Support

Untuk pertanyaan atau bantuan, hubungi developer atau buka issue di repository.

## 📄 License

Proprietary - Pondok Pesantren Riyadussalikin Padaherang

---

**Dibuat dengan ❤️ untuk Pondok Pesantren Riyadussalikin Padaherang**
