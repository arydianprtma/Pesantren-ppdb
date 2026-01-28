# Quick Start Guide

## Cara Menjalankan Website

### 1. Pastikan Server Sudah Berjalan

Website sudah siap dijalankan! Berikut langkah-langkahnya:

```bash
# Jika belum running, jalankan server Laravel
php artisan serve
```

Server akan berjalan di: **http://localhost:8000**

### 2. Buka di Browser

Buka browser dan akses:
- **Beranda**: http://localhost:8000
- **Visi & Misi**: http://localhost:8000/visi-misi
- **Prestasi**: http://localhost:8000/prestasi
- **Kontak**: http://localhost:8000/kontak

### 3. Test Fitur

✅ **Navigasi**: Klik menu di navbar untuk berpindah halaman
✅ **Filter Prestasi**: Di halaman Prestasi, coba filter berdasarkan kategori dan tahun
✅ **Form Kontak**: Isi form kontak dan kirim pesan
✅ **Responsive**: Resize browser untuk melihat tampilan mobile
✅ **Tombol PPDB**: Klik tombol PPDB di navbar (akan redirect ke link eksternal)

### 4. Cek Data di Database

Buka phpMyAdmin dan lihat:
- Tabel `prestasis` - Berisi 8 data dummy prestasi
- Tabel `contact_messages` - Akan berisi pesan dari form kontak

## Troubleshooting Cepat

**Halaman tidak muncul?**
```bash
npm run build
php artisan config:clear
php artisan cache:clear
```

**Database error?**
```bash
php artisan migrate:fresh --seed
```

**Logo tidak muncul?**
- Pastikan file `public/logo.png` ada

## Apa Selanjutnya?

1. ✅ Website publik sudah jadi dan berjalan
2. ⏳ Dashboard admin (Filament) akan ditambahkan di update selanjutnya
3. 📝 Ganti data dummy dengan data real pesantren
4. 🎨 Sesuaikan kontak, alamat, dan link PPDB

---

**Selamat! Website Pondok Pesantren Riyadussalikin sudah siap digunakan! 🎉**
