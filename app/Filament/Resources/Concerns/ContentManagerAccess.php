<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Support\Facades\Auth;

/**
 * Trait untuk Resource yang dapat diakses oleh semua role admin panel
 * (Super Admin, Admin, dan Editor)
 *
 * Gunakan pada: Berita, Prestasi, Fasilitas, Sejarah, VisiMisi, Ekstrakurikuler, Kontak
 */
trait ContentManagerAccess
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

        if (!$user->canManageContent()) {
            return false;
        }

        // Ambil nama class resource
        $resourceName = class_basename(static::class);
        $permissionKey = \Illuminate\Support\Str::snake($resourceName);
        
        // Format permission Shield v4: view_any_{resource_name_snake}
        return $user->can("view_any_{$permissionKey}");
    }
}
