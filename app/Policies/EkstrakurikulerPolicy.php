<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Ekstrakurikuler;
use Illuminate\Auth\Access\HandlesAuthorization;

class EkstrakurikulerPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_ekstrakurikuler_resource');
    }

    public function view(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('view_ekstrakurikuler_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_ekstrakurikuler_resource');
    }

    public function update(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('update_ekstrakurikuler_resource');
    }

    public function delete(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('delete_ekstrakurikuler_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_ekstrakurikuler_resource');
    }

    public function restore(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('restore_ekstrakurikuler_resource');
    }

    public function forceDelete(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('force_delete_ekstrakurikuler_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_ekstrakurikuler_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_ekstrakurikuler_resource');
    }

    public function replicate(AuthUser $authUser, Ekstrakurikuler $ekstrakurikuler): bool
    {
        return $authUser->can('replicate_ekstrakurikuler_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_ekstrakurikuler_resource');
    }

}