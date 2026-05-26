<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Sejarah;
use Illuminate\Auth\Access\HandlesAuthorization;

class SejarahPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_sejarah_resource');
    }

    public function view(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('view_sejarah_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_sejarah_resource');
    }

    public function update(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('update_sejarah_resource');
    }

    public function delete(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('delete_sejarah_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_sejarah_resource');
    }

    public function restore(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('restore_sejarah_resource');
    }

    public function forceDelete(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('force_delete_sejarah_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_sejarah_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_sejarah_resource');
    }

    public function replicate(AuthUser $authUser, Sejarah $sejarah): bool
    {
        return $authUser->can('replicate_sejarah_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_sejarah_resource');
    }

}