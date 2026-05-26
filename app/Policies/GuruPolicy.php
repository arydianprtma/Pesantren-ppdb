<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Guru;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuruPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_guru_resource');
    }

    public function view(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('view_guru_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_guru_resource');
    }

    public function update(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('update_guru_resource');
    }

    public function delete(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('delete_guru_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_guru_resource');
    }

    public function restore(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('restore_guru_resource');
    }

    public function forceDelete(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('force_delete_guru_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_guru_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_guru_resource');
    }

    public function replicate(AuthUser $authUser, Guru $guru): bool
    {
        return $authUser->can('replicate_guru_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_guru_resource');
    }

}