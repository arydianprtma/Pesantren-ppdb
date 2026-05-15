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
        Schema::table('beritas', function (Blueprint $table) {
            $table->index('published_at');
            $table->index('is_published');
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropIndex(['published_at']);
            $table->dropIndex(['is_published']);
            $table->dropIndex(['kategori']);
        });
    }
};
