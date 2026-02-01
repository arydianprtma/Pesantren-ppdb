<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ppdb_registrants', function (Blueprint $table) {
            // Pendidikan Terakhir Orang Tua
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable()->after('pekerjaan_ayah');
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable()->after('pekerjaan_ibu');

            // Penghasilan Orang Tua
            $table->enum('penghasilan_ortu', ['<1jt', '1-3jt', '3-5jt', '>5jt'])->nullable()->after('no_hp_ortu');

            // Alamat Orang Tua
            $table->boolean('alamat_ortu_sama')->default(false)->after('penghasilan_ortu');
            $table->text('alamat_ortu')->nullable()->after('alamat_ortu_sama');

            // Status Orang Tua
            $table->enum('status_ortu', ['lengkap', 'ayah_saja', 'ibu_saja', 'wali'])->nullable()->after('alamat_ortu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_registrants', function (Blueprint $table) {
            $table->dropColumn([
                'pendidikan_ayah',
                'pendidikan_ibu',
                'penghasilan_ortu',
                'alamat_ortu_sama',
                'alamat_ortu',
                'status_ortu',
            ]);
        });
    }
};
