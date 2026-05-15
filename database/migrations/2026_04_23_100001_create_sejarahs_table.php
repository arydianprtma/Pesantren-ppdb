<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('periode')->nullable(); // e.g. "Awal", "1995–2000", "Kini"
            $table->text('konten');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
