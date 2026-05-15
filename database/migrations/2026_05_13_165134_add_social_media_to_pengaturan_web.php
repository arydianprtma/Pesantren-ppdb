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
        Schema::table('pengaturan_web', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('virtual_tour_url');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('tiktok')->nullable()->after('instagram');
            $table->string('youtube')->nullable()->after('tiktok');
            $table->string('whatsapp')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_web', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'instagram', 'tiktok', 'youtube', 'whatsapp']);
        });
    }
};
