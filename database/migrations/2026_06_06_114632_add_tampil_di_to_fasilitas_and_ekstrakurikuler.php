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
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->string('tampil_di')->default('keduanya')->after('is_active');
        });

        Schema::table('ekstrakurikuler', function (Blueprint $table) {
            $table->string('tampil_di')->default('keduanya')->after('is_active');
        });

        // Migrate existing data from is_unggulan to tampil_di
        if (Schema::hasColumn('ekstrakurikuler', 'is_unggulan')) {
            DB::table('ekstrakurikuler')
                ->where('is_unggulan', true)
                ->update(['tampil_di' => 'keduanya']);

            DB::table('ekstrakurikuler')
                ->where('is_unggulan', false)
                ->update(['tampil_di' => 'pesantren']);

            Schema::table('ekstrakurikuler', function (Blueprint $table) {
                $table->dropColumn('is_unggulan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('ekstrakurikuler', 'is_unggulan')) {
            Schema::table('ekstrakurikuler', function (Blueprint $table) {
                $table->boolean('is_unggulan')->default(false)->after('is_active');
            });
        }

        // Migrate back
        DB::table('ekstrakurikuler')
            ->where('tampil_di', 'keduanya')
            ->update(['is_unggulan' => true]);

        Schema::table('ekstrakurikuler', function (Blueprint $table) {
            $table->dropColumn('tampil_di');
        });

        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('tampil_di');
        });
    }
};
