<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kontak;
use Illuminate\Auth\Access\HandlesAuthorization;

class KontakPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_kontak_resource');
    }

    public function view(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('view_kontak_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_kontak_resource');
    }

    public function update(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('update_kontak_resource');
    }

    public function delete(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('delete_kontak_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_kontak_resource');
    }

    public function restore(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('restore_kontak_resource');
    }

    public function forceDelete(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('force_delete_kontak_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_kontak_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_kontak_resource');
    }

    public function replicate(AuthUser $authUser, Kontak $kontak): bool
    {
        return $authUser->can('replicate_kontak_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_kontak_resource');
    }

}