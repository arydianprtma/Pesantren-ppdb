<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $renames = [
            'ppdb_pendaftaran' => 'ppdb_pendaftaran',
            'ppdb_siswa' => 'ppdb_siswa',
            'ppdb_orang_tua' => 'ppdb_orang_tua',
            'ppdb_wali' => 'ppdb_wali',
            'ppdb_periodik' => 'ppdb_periodik',
            'ppdb_prestasi' => 'ppdb_prestasi',
            'ppdb_beasiswa' => 'ppdb_beasiswa',
            'ppdb_berkas' => 'ppdb_berkas',
            'ppdb_pendaftarans' => 'ppdb_pendaftarans',
            'ppdb_settings' => 'ppdb_settings',
            'pendaftar_ppdb' => 'pendaftar_ppdb',
        ];

        foreach ($renames as $from => $to) {
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $renames = [
            'ppdb_pendaftaran' => 'ppdb_pendaftaran',
            'ppdb_siswa' => 'ppdb_siswa',
            'ppdb_orang_tua' => 'ppdb_orang_tua',
            'ppdb_wali' => 'ppdb_wali',
            'ppdb_periodik' => 'ppdb_periodik',
            'ppdb_prestasi' => 'ppdb_prestasi',
            'ppdb_beasiswa' => 'ppdb_beasiswa',
            'ppdb_berkas' => 'ppdb_berkas',
            'ppdb_pendaftarans' => 'ppdb_pendaftarans',
            'ppdb_settings' => 'ppdb_settings',
            'pendaftar_ppdb' => 'pendaftar_ppdb',
        ];

        foreach ($renames as $from => $to) {
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }
};
