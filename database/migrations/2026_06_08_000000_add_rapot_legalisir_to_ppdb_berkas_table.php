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
        if (Schema::hasTable('ppdb_berkas')) {
            Schema::table('ppdb_berkas', function (Blueprint $table) {
                if (!Schema::hasColumn('ppdb_berkas', 'rapot_legalisir')) {
                    $table->string('rapot_legalisir')->nullable()->after('ijazah_skhu')->comment('Rapot semester terakhir legalisir & data siswa 1 lembar');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ppdb_berkas')) {
            Schema::table('ppdb_berkas', function (Blueprint $table) {
                if (Schema::hasColumn('ppdb_berkas', 'rapot_legalisir')) {
                    $table->dropColumn('rapot_legalisir');
                }
            });
        }
    }
};
