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
        Schema::table('prestasis', function (Blueprint $table) {
            $table->index('tahun');
            $table->index('kategori');
            $table->index('tingkat');
        });
    }

    public function down(): void
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropIndex(['tahun']);
            $table->dropIndex(['kategori']);
            $table->dropIndex(['tingkat']);
        });
    }
};
