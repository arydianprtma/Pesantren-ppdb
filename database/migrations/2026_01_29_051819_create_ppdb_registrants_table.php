<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdb_registrants', function (Blueprint $table) {
            $table->id();
            // Data Diri
            $table->string('nama_lengkap');
            $table->string('nisn')->unique()->nullable();
            $table->enum('jenjang', ['MTS', 'MA']); // MTS=SMP, MA=SMA
            $table->string('asal_sekolah');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();

            // Data Orang Tua
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ortu')->nullable();

            // Berkas (Path File)
            $table->string('file_ijazah')->nullable();
            $table->string('file_skhu')->nullable();
            $table->string('file_raport')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();

            $table->enum('status', ['pending', 'verified', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrants');
    }
};
