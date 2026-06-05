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
        if (!Schema::hasColumn('ppdb_pendaftaran', 'tahun_ajaran')) {
            Schema::table('ppdb_pendaftaran', function (Blueprint $table) {
                $table->string('tahun_ajaran', 15)->nullable()->after('status');
            });

            // Isi data tahun_ajaran pendaftaran yang sudah ada berdasarkan tanggal_daftar
            \Illuminate\Support\Facades\DB::table('ppdb_pendaftaran')->get()->each(function ($pendaftaran) {
                $year = date('Y', strtotime($pendaftaran->tanggal_daftar));
                $tahunAjaran = $year . '/' . ($year + 1);
                \Illuminate\Support\Facades\DB::table('ppdb_pendaftaran')
                    ->where('id', $pendaftaran->id)
                    ->update(['tahun_ajaran' => $tahunAjaran]);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('ppdb_pendaftaran', 'tahun_ajaran')) {
            Schema::table('ppdb_pendaftaran', function (Blueprint $table) {
                $table->dropColumn('tahun_ajaran');
            });
        }
    }
};
