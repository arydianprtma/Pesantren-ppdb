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
        Schema::table('visi_misis', function (Blueprint $table) {
            $table->string('nama_pengasuh')->nullable()->after('misi');
            $table->string('foto_pengasuh')->nullable()->after('nama_pengasuh');
            $table->text('kata_sambutan')->nullable()->after('foto_pengasuh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visi_misis', function (Blueprint $table) {
            $table->dropColumn(['nama_pengasuh', 'foto_pengasuh', 'kata_sambutan']);
        });
    }
};
