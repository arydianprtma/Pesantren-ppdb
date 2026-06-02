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
        if (!Schema::hasTable('ppdb_settings')) {
            Schema::create('ppdb_settings', function (Blueprint $table) {
                $table->id();
                $table->string('tahun_ajaran'); // Contoh: 2026/2027
                $table->dateTime('tgl_buka');
                $table->dateTime('tgl_tutup');
                $table->boolean('is_active')->default(true);
                $table->text('pesan_tutup')->nullable(); // Pesan yang muncul saat pendaftaran ditutup
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_settings');
    }
};
