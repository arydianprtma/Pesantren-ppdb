<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->enum('role', ['super_admin', 'admin', 'editor'])->default('admin')->after('avatar');
            $table->json('permissions')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('permissions');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'role', 'permissions', 'is_active']);
        });
    }
};
