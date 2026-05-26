<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Trait untuk Resource yang hanya dapat diakses oleh Super Admin dan Admin
 * (tidak termasuk Editor)
 *
 * Gunakan pada: SPMB, DataSiswa, Guru, Pesan Masuk, Pengaturan, SpmbSetting
 */
trait AdminOnlyAccess
{
    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Super Admin selalu memiliki akses ke semua menu
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if (!$user->isAdmin()) {
            return false;
        }

        // Ambil nama class resource
        $resourceName = class_basename(static::class);
        $permissionKey = \Illuminate\Support\Str::snake($resourceName);
        
        // Format permission Shield v4: view_any_{resource_name_snake}
        return $user->can("view_any_{$permissionKey}");
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        if ($user->hasRole('super_admin')) {
            return true;
        }

        if (!$user->isAdmin()) {
            return false;
        }

        $classBasename = class_basename(static::class);
        $permissionKey = \Illuminate\Support\Str::snake($classBasename);

        if (\Illuminate\Support\Str::endsWith($classBasename, 'Resource')) {
            return $user->can("view_any_{$permissionKey}");
        }

        return $user->can("view_{$permissionKey}");
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }
}
