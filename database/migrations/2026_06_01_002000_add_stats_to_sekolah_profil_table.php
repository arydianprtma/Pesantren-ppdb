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
        Schema::table('sekolah_profil', function (Blueprint $table) {
            $table->string('stat_1_val')->default('A')->after('is_active');
            $table->string('stat_1_lbl')->default('Akreditasi BAN-SM')->after('stat_1_val');
            $table->string('stat_2_val')->default('100%')->after('stat_1_lbl');
            $table->string('stat_2_lbl')->default('Kurikulum Terintegrasi')->after('stat_2_val');
            $table->string('stat_3_val')->default('1:15')->after('stat_2_lbl');
            $table->string('stat_3_lbl')->default('Rasio Guru & Siswa')->after('stat_3_val');
            $table->string('stat_4_val')->default('10+')->after('stat_3_lbl');
            $table->string('stat_4_lbl')->default('Fasilitas Penunjang')->after('stat_4_val');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sekolah_profil', function (Blueprint $table) {
            $table->dropColumn([
                'stat_1_val', 'stat_1_lbl',
                'stat_2_val', 'stat_2_lbl',
                'stat_3_val', 'stat_3_lbl',
                'stat_4_val', 'stat_4_lbl'
            ]);
        });
    }
};
