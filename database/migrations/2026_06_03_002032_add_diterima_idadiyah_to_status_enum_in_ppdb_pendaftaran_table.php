<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        // Temporarily change to VARCHAR to avoid enum constraints issues
        DB::statement("ALTER TABLE ppdb_pendaftaran MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");

        // Re-apply the ENUM definition with 'diterima_idadiyah' included
        DB::statement("ALTER TABLE ppdb_pendaftaran MODIFY COLUMN status ENUM(
            'pending',
            'jadwal_tes',
            'tes_berlangsung',
            'wawancara',
            'diterima_ula',
            'diterima_idadiyah',
            'diterima_wustho',
            'diterima_ulya',
            'diterima',
            'ditolak'
        ) DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        // Revert to original ENUM without 'diterima_idadiyah'
        // First map any 'diterima_idadiyah' to 'diterima_ula' to avoid data deletion
        DB::statement("UPDATE ppdb_pendaftaran SET status = 'diterima_ula' WHERE status = 'diterima_idadiyah'");

        DB::statement("ALTER TABLE ppdb_pendaftaran MODIFY COLUMN status ENUM(
            'pending',
            'jadwal_tes',
            'tes_berlangsung',
            'wawancara',
            'diterima_ula',
            'diterima_wustho',
            'diterima_ulya',
            'diterima',
            'ditolak'
        ) DEFAULT 'pending'");
    }
};
