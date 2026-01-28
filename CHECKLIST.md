# Checklist Kustomisasi Website

Gunakan checklist ini untuk menyesuaikan website dengan data real Pondok Pesantren Riyadussalikin.

## 📋 Data Kontak & Informasi

### File: `resources/js/Layouts/MainLayout.vue`

- [ ] **Alamat Footer** (baris ~118)
  ```vue
  <p>Jl. Raya Padaherang, Pangandaran</p>
  <p>WhatsApp: +62 812-3456-7890</p>
  <p>Email: info@riyadussalikin.sch.id</p>
  ```

### File: `resources/js/Pages/Contact.vue`

- [ ] **Alamat Lengkap** (baris ~32)
  ```vue
  <p>Jl. Raya Padaherang No. 123<br>Padaherang, Pangandaran<br>Jawa Barat 46396</p>
  ```

- [ ] **Nomor WhatsApp** (baris ~48)
  ```vue
  <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
  ```

- [ ] **Email** (baris ~61)
  ```vue
  <a href="mailto:info@riyadussalikin.sch.id">info@riyadussalikin.sch.id</a>
  ```

- [ ] **Google Maps** (baris ~72)
  - Update URL embed dengan koordinat real pesantren
  - Cara: Buka Google Maps → Cari lokasi → Share → Embed a map → Copy HTML

## 🔗 Link Eksternal

### File: `resources/js/Layouts/MainLayout.vue` & `resources/js/Pages/Home.vue`

- [ ] **Link PPDB** 
  - Ganti `https://ppdb.riyadussalikin.sch.id` dengan URL real website PPDB
  - Lokasi di MainLayout: baris ~46 dan ~74
  - Lokasi di Home: baris ~24 dan ~146

## 🎨 Branding

### Logo

- [ ] **Ganti Logo** (jika perlu)
  - File: `public/logo.png`
  - Ukuran recommended: 512x512px atau 1024x1024px
  - Format: PNG dengan background transparan

### Warna (Opsional)

- [ ] **Sesuaikan Warna Brand**
  - File: `resources/css/app.css`
  - Primary color (hijau emerald): `--color-primary-500: #10b981;`
  - Accent color (kuning/emas): `--color-accent-500: #eab308;`

## 📝 Konten

### File: `resources/js/Pages/Home.vue`

- [ ] **Slogan** (baris ~19)
  ```vue
  <p>Membentuk Generasi Qur'ani yang Berakhlak Mulia, Berilmu, dan Mandiri</p>
  ```

- [ ] **Deskripsi Singkat** (baris ~36)
  - Update sesuai profil real pesantren

### File: `resources/js/Pages/VisiMisi.vue`

- [ ] **Visi** (baris ~23)
  - Update dengan visi real pesantren

- [ ] **Misi** (baris ~38-92)
  - Update dengan misi real pesantren
  - Tambah/kurangi poin sesuai kebutuhan

- [ ] **Nilai-Nilai** (baris ~104-158)
  - Update dengan nilai-nilai real pesantren

## 🏆 Data Prestasi

### Database

- [ ] **Hapus Data Dummy**
  ```sql
  DELETE FROM prestasis;
  ```

- [ ] **Tambah Data Real**
  - Via phpMyAdmin: Tabel `prestasis` → Insert
  - Via Seeder: Edit `database/seeders/PrestasiSeeder.php`
  - Kolom:
    - `judul`: Nama prestasi
    - `kategori`: `akademik`, `non_akademik`, atau `keagamaan`
    - `tingkat`: Kecamatan, Kabupaten, Provinsi, Nasional, Internasional
    - `tahun`: Tahun prestasi (YYYY)
    - `deskripsi`: Deskripsi singkat (opsional)

## ⚙️ Konfigurasi

### File: `.env`

- [ ] **APP_NAME**
  ```env
  APP_NAME="Pondok Pesantren Riyadussalikin"
  ```

- [ ] **APP_URL** (untuk production)
  ```env
  APP_URL=https://riyadussalikin.sch.id
  ```

- [ ] **Database** (sudah dikonfigurasi)
  ```env
  DB_DATABASE=pesantren_db
  ```

## 🚀 Sebelum Go Live (Production)

- [ ] Set `APP_DEBUG=false` di `.env`
- [ ] Set `APP_ENV=production` di `.env`
- [ ] Generate APP_KEY baru: `php artisan key:generate`
- [ ] Update semua data dummy dengan data real
- [ ] Test semua halaman dan fitur
- [ ] Test di berbagai device (mobile, tablet, desktop)
- [ ] Test di berbagai browser (Chrome, Firefox, Safari, Edge)
- [ ] Setup SSL/HTTPS
- [ ] Setup backup database
- [ ] Setup monitoring

## ✅ Setelah Kustomisasi

Setelah semua checklist di atas selesai:

```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Rebuild assets
npm run build

# Restart server
php artisan serve
```

---

**Tips**: Simpan file ini dan centang setiap item yang sudah dikerjakan!
