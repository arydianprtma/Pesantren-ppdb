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
        Schema::create('sekolah_profil', function (Blueprint $table) {
            $table->id();
            $table->text('profil');
            $table->text('visi');
            $table->text('misi');
            $table->string('nama_kepsek')->nullable();
            $table->string('foto_kepsek')->nullable();
            $table->text('sambutan_kepsek')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_profil');
    }
};
