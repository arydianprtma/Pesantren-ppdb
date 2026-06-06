<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ppdb_pendaftaran', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable()->after('status')->constrained('kelas')->onDelete('set null');
        });

        if (DB::getDriverName() === 'mysql') {
            // Temporarily change to VARCHAR to avoid enum constraints issues
            DB::statement("ALTER TABLE ppdb_pendaftaran MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");

            // Re-apply the ENUM definition with 'lulus' included
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
                'mengundurkan_diri',
                'lulus'
            ) DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            // Revert to original ENUM without 'lulus'
            // First map any 'lulus' to 'pending' to avoid data deletion
            DB::statement("UPDATE ppdb_pendaftaran SET status = 'pending' WHERE status = 'lulus'");

            DB::statement("ALTER TABLE ppdb_pendaftaran MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");

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

        Schema::table('ppdb_pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
