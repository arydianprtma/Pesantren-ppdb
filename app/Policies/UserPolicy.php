<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_user_resource');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('view_user_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_user_resource');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('update_user_resource');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('delete_user_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_user_resource');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('restore_user_resource');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_user_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_user_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_user_resource');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('replicate_user_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_user_resource');
    }

}