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
        Schema::table('pengaturan_web', function (Blueprint $table) {
            $table->integer('jml_ekstrakurikuler')->default(0);
            $table->string('akreditasi')->default('A');
            $table->integer('jml_tenaga_pengajar')->default(0);
            $table->integer('jml_unit_sekolah')->default(0);
            $table->string('persentase_kelulusan')->default('100%');
            $table->integer('base_santri_aktif')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_web', function (Blueprint $table) {
            $table->dropColumn([
                'jml_ekstrakurikuler',
                'akreditasi',
                'jml_tenaga_pengajar',
                'jml_unit_sekolah',
                'persentase_kelulusan',
                'base_santri_aktif'
            ]);
        });
    }
};
