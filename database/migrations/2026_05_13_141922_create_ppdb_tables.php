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
        // 1. Master Pendaftaran
        Schema::create('spmb_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_reg')->unique();
            $table->date('tanggal_daftar');
            $table->enum('tingkat', ['smp', 'sma']);
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });

        // 2. Identitas Siswa
        Schema::create('spmb_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nisn', 10)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('no_skhun')->nullable();
            $table->string('no_un')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_registrasi_akta')->nullable();
            $table->string('agama')->default('Islam');
            $table->string('kewarganegaraan')->default('Indonesia');
            $table->string('nama_negara')->nullable();
            $table->string('berkebutuhan_khusus')->nullable();
            $table->text('alamat');
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan_desa');
            $table->string('kecamatan');
            $table->string('kode_pos', 5)->nullable();
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('alat_transportasi')->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->string('no_telp_rumah')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email_pribadi')->nullable();
            $table->boolean('penerima_kps_pkh')->default(false);
            $table->string('no_kps_pkh')->nullable();
            $table->string('no_kks')->nullable();
            $table->integer('anak_keberapa')->nullable();
            $table->boolean('penerima_kip')->default(false);
            $table->string('no_kip')->nullable();
            $table->string('nama_tertera_kip')->nullable();
            $table->boolean('terima_fisik_kip')->default(false);
            $table->string('bank_rekening')->nullable();
            $table->string('no_rek_bank')->nullable();
            $table->string('rekening_atas_nama')->nullable();
            $table->boolean('layak_pip')->default(false);
            $table->string('alasan_layak_pip')->nullable();
            $table->string('ukuran_pakaian')->nullable();
            $table->string('no_sepatu')->nullable();
            $table->string('no_kopiyah')->nullable();
            $table->timestamps();
        });

        // 3. Data Orang Tua (Ayah & Ibu)
        Schema::create('spmb_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->enum('jenis', ['ayah', 'ibu']);
            $table->string('nama');
            $table->string('nik', 16)->nullable();
            $table->year('tahun_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan_bulanan')->nullable();
            $table->string('berkebutuhan_khusus')->nullable();
            $table->timestamps();
        });

        // 4. Data Wali
        Schema::create('spmb_wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik', 16)->nullable();
            $table->year('tahun_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan_bulanan')->nullable();
            $table->timestamps();
        });

        // 5. Data Periodik
        Schema::create('spmb_periodik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('jarak_ke_sekolah')->nullable();
            $table->integer('jarak_km')->nullable();
            $table->string('waktu_tempuh')->nullable();
            $table->integer('waktu_menit')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->timestamps();
        });

        // 6. Data Prestasi
        Schema::create('spmb_prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->string('jenis_prestasi')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('nama_prestasi')->nullable();
            $table->year('tahun')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->timestamps();
        });

        // 7. Data Beasiswa
        Schema::create('spmb_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('spmb_pendaftaran')->onDelete('cascade');
            $table->string('jenis_beasiswa')->nullable();
            $table->string('penyelenggara_sumber')->nullable();
            $table->year('tahun_mulai')->nullable();
            $table->year('tahun_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmb_beasiswa');
        Schema::dropIfExists('spmb_prestasi');
        Schema::dropIfExists('spmb_periodik');
        Schema::dropIfExists('spmb_wali');
        Schema::dropIfExists('spmb_orang_tua');
        Schema::dropIfExists('spmb_siswa');
        Schema::dropIfExists('spmb_pendaftaran');
    }
};
