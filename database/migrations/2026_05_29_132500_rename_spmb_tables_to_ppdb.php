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
            'spmb_pendaftaran' => 'ppdb_pendaftaran',
            'spmb_siswa' => 'ppdb_siswa',
            'spmb_orang_tua' => 'ppdb_orang_tua',
            'spmb_wali' => 'ppdb_wali',
            'spmb_periodik' => 'ppdb_periodik',
            'spmb_prestasi' => 'ppdb_prestasi',
            'spmb_beasiswa' => 'ppdb_beasiswa',
            'spmb_berkas' => 'ppdb_berkas',
            'spmb_pendaftarans' => 'ppdb_pendaftarans',
            'spmb_settings' => 'ppdb_settings',
            'pendaftar_spmb' => 'pendaftar_ppdb',
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
            'ppdb_pendaftaran' => 'spmb_pendaftaran',
            'ppdb_siswa' => 'spmb_siswa',
            'ppdb_orang_tua' => 'spmb_orang_tua',
            'ppdb_wali' => 'spmb_wali',
            'ppdb_periodik' => 'spmb_periodik',
            'ppdb_prestasi' => 'spmb_prestasi',
            'ppdb_beasiswa' => 'spmb_beasiswa',
            'ppdb_berkas' => 'spmb_berkas',
            'ppdb_pendaftarans' => 'spmb_pendaftarans',
            'ppdb_settings' => 'spmb_settings',
            'pendaftar_ppdb' => 'pendaftar_spmb',
        ];

        foreach ($renames as $from => $to) {
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }
};
