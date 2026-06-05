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

        // Re-apply the ENUM definition with 'mengundurkan_diri' included
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
            'ditolak',
            'mengundurkan_diri'
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

        // Revert to original ENUM without 'mengundurkan_diri'
        // First map any 'mengundurkan_diri' to 'pending' to avoid data deletion
        DB::statement("UPDATE ppdb_pendaftaran SET status = 'pending' WHERE status = 'mengundurkan_diri'");

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
};
