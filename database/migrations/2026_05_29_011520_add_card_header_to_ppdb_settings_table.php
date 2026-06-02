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
        Schema::table('ppdb_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('ppdb_settings', 'kartu_header_1')) {
                $table->string('kartu_header_1')->nullable(); // Contoh: Panitia Penerimaan Santri Baru (PSB)
            }
            if (!Schema::hasColumn('ppdb_settings', 'kartu_header_2')) {
                $table->string('kartu_header_2')->nullable(); // Contoh: Pondok Pesantren Riyadussalikin
            }
            if (!Schema::hasColumn('ppdb_settings', 'kartu_alamat')) {
                $table->string('kartu_alamat')->nullable(); // Contoh: Padaherang, Kabupaten Pangandaran, Jawa Barat
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_settings', function (Blueprint $table) {
            $table->dropColumn(['kartu_header_1', 'kartu_header_2', 'kartu_alamat']);
        });
    }
};
