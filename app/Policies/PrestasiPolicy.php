<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Prestasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrestasiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_prestasi_resource');
    }

    public function view(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('view_prestasi_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_prestasi_resource');
    }

    public function update(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('update_prestasi_resource');
    }

    public function delete(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('delete_prestasi_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_prestasi_resource');
    }

    public function restore(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('restore_prestasi_resource');
    }

    public function forceDelete(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('force_delete_prestasi_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_prestasi_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_prestasi_resource');
    }

    public function replicate(AuthUser $authUser, Prestasi $prestasi): bool
    {
        return $authUser->can('replicate_prestasi_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_prestasi_resource');
    }

}