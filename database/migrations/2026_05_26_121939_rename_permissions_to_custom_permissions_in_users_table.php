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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'permissions') && !Schema::hasColumn('users', 'custom_permissions')) {
                $table->renameColumn('permissions', 'custom_permissions');
            } elseif (!Schema::hasColumn('users', 'custom_permissions')) {
                $table->json('custom_permissions')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'custom_permissions')) {
                $table->renameColumn('custom_permissions', 'permissions');
            }
        });
    }
};
