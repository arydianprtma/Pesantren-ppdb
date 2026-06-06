<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kelas;
use Illuminate\Auth\Access\HandlesAuthorization;

class KelasPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_kelas_resource');
    }

    public function view(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('view_kelas_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_kelas_resource');
    }

    public function update(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('update_kelas_resource');
    }

    public function delete(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('delete_kelas_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_kelas_resource');
    }

    public function restore(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('restore_kelas_resource');
    }

    public function forceDelete(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('force_delete_kelas_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_kelas_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_kelas_resource');
    }

    public function replicate(AuthUser $authUser, Kelas $kelas): bool
    {
        return $authUser->can('replicate_kelas_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_kelas_resource');
    }
}
