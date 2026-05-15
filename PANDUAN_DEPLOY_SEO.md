# Panduan Deploy & Optimasi SEO Pesantren PPDB

Dokumen ini berisi langkah-langkah penting yang harus dilakukan setelah Anda melakukan pendaftaran domain dan menyewa VPS.

## 1. Konfigurasi Domain di VPS
Setelah file proyek diupload ke VPS:
- Edit file `.env` di root folder aplikasi utama:
  ```env
  APP_URL=https://domain-anda.com
  ```
- Edit file `.env` di root folder portal SPMB:
  ```env
  APP_URL=https://domain-anda.com
  ```
- Pastikan SSL (HTTPS) sudah aktif menggunakan Let's Encrypt atau Certbot.

## 2. Update Sitemap (SEO)
Setelah `APP_URL` diubah menjadi domain asli, jalankan perintah berikut di terminal VPS (dalam folder aplikasi utama):
```bash
php artisan sitemap:generate
```
Perintah ini akan memperbarui file `public/sitemap.xml` agar semua link di dalamnya menggunakan domain asli Anda.

## 3. Pendaftaran ke Google Search Console
Agar website cepat muncul di pencarian Google:
1. Buka [Google Search Console](https://search.google.com/search-console/).
2. Tambahkan Properti Baru (URL Prefix atau Domain).
3. Lakukan verifikasi kepemilikan (biasanya dengan mengupload file HTML atau menambahkan record DNS).
4. Di menu sidebar, klik **Sitemaps**.
5. Masukkan URL sitemap Anda: `https://domain-anda.com/sitemap.xml` lalu klik **Submit**.

## 4. Optimasi Gambar & RAM (Penting untuk VPS 1GB)
Karena VPS Anda memiliki RAM 1GB, pastikan langkah-langkah berikut sudah dilakukan:
- **Buat SWAP File**: Tambahkan minimal 2GB swap.
  ```bash
  sudo fallocate -l 2G /swapfile
  sudo chmod 600 /swapfile
  sudo mkswap /swapfile
  sudo swapon /swapfile
  ```
- **Build Aset di Lokal**: Jalankan `npm run build` di komputer lokal Anda, lalu upload folder `public/build` ke VPS. Jangan jalankan `npm run dev` atau `npm run build` di VPS karena bisa menghabiskan RAM.

## 5. Otomatisasi (Cron Job)
Tambahkan scheduler Laravel ke crontab VPS agar sitemap diperbarui otomatis setiap hari:
1. Jalankan `crontab -e`.
2. Tambahkan baris berikut (sesuaikan path folder):
   ```bash
   * * * * * cd /path-ke-proyek-anda && php artisan schedule:run >> /dev/null 2>&1
   ```