<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_role_resource');
    }

    public function view(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('view_role_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_role_resource');
    }

    public function update(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('update_role_resource');
    }

    public function delete(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('delete_role_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_role_resource');
    }

    public function restore(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('restore_role_resource');
    }

    public function forceDelete(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('force_delete_role_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_role_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_role_resource');
    }

    public function replicate(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('replicate_role_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_role_resource');
    }

}