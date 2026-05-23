<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // Modify the ENUM to include 'siswa'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'editor', 'siswa') NULL DEFAULT NULL");

        // Update existing users that have no role set to NULL
        DB::statement("UPDATE users SET role = NULL WHERE role = 'admin' AND created_at > NOW() - INTERVAL 1 MINUTE");
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // Revert 'siswa' users to NULL before removing the enum value
        DB::statement("UPDATE users SET role = NULL WHERE role = 'siswa'");
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin'");
    }
};
