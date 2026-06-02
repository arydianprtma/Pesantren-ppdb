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
        if (Schema::hasTable('ppdb_registrants') && !Schema::hasTable('ppdb_registrants')) {
            Schema::rename('ppdb_registrants', 'ppdb_registrants');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ppdb_registrants', 'ppdb_registrants');
    }
};
