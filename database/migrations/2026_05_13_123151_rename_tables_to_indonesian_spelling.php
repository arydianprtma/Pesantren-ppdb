<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('beritas', 'berita');
        Schema::rename('contact_messages', 'pesan_kontak');
        Schema::rename('fasilitases', 'fasilitas');
        Schema::rename('kontaks', 'kontak');
        Schema::rename('prestasis', 'prestasi');
        Schema::rename('sejarahs', 'sejarah');
        Schema::rename('spmb_registrants', 'pendaftar_spmb');
        Schema::rename('visi_misis', 'visi_misi');
        Schema::rename('web_settings', 'pengaturan_web');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('berita', 'beritas');
        Schema::rename('pesan_kontak', 'contact_messages');
        Schema::rename('fasilitas', 'fasilitases');
        Schema::rename('kontak', 'kontaks');
        Schema::rename('prestasi', 'prestasis');
        Schema::rename('sejarah', 'sejarahs');
        Schema::rename('pendaftar_spmb', 'spmb_registrants');
        Schema::rename('visi_misi', 'visi_misis');
        Schema::rename('pengaturan_web', 'web_settings');
    }
};
