#!/bin/bash
set -e

echo "🚀 Memulai Setup VPS Otomatis untuk Pesantren PPDB..."

# 1. Update OS & Install Docker jika belum ada
if ! command -v docker &> /dev/null; then
    echo "📦 Menginstall Docker & Docker Compose..."
    curl -fsSL https://get.docker.com | sh
    systemctl enable docker
    systemctl start docker
fi

# Konfigurasi DNS Docker agar docker build tidak gagal resolving domain di VPS
if [ ! -f /etc/docker/daemon.json ] || ! grep -q "8.8.8.8" /etc/docker/daemon.json; then
    echo "🌐 Mengonfigurasi DNS resolver untuk Docker..."
    echo '{"dns": ["8.8.8.8", "1.1.1.1"]}' > /etc/docker/daemon.json
    systemctl restart docker
fi

# 2. Pastikan submodul repositori PPDB (spmb-ppdb) tersedia
if [ ! -d "PPDB" ] || [ ! -f "PPDB/composer.json" ]; then
    echo "📥 Mengkloning repositori PPDB (spmb-ppdb)..."
    git clone https://github.com/arydianprtma/spmb-ppdb.git PPDB
else
    echo "✅ Repositori PPDB (spmb-ppdb) sudah tersedia. Memperbarui..."
    cd PPDB && git pull origin main && cd ..
fi

# 3. Buat folder sertifikat Cloudflare jika belum ada
mkdir -p /etc/ssl/cloudflare

if [ ! -f /etc/ssl/cloudflare/riyadussalikin.crt ]; then
    echo "⚠️  PERINGATAN: Berkas sertifikat /etc/ssl/cloudflare/riyadussalikin.crt belum ditemukan!"
    echo "   Membuat self-signed certificate sementara agar Nginx langsung berjalan aman..."
    openssl req -x509 -nodes -days 3650 -newkey rsa:2048 \
        -keyout /etc/ssl/cloudflare/riyadussalikin.key \
        -out /etc/ssl/cloudflare/riyadussalikin.crt \
        -subj "/C=ID/ST=JawaBarat/L=Sukabumi/O=PondokPesantrenRiyadussalikin/CN=riyadussalikin.ponpes.id"
    echo "✅ SSL Certificate siap."
fi

# 4. Jalankan Docker Compose
echo "🐳 Menjalankan seluruh sistem via Docker Compose..."
docker compose up -d

echo "✅ Sistem Pesantren PPDB berhasil dijalankan!"
echo "   Periksa status container: docker compose ps"
echo "   Pantau log aplikasi:      docker compose logs -f app"
