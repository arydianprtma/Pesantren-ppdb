<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Fasilitas;
use Illuminate\Auth\Access\HandlesAuthorization;

class FasilitasPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_fasilitas_resource');
    }

    public function view(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('view_fasilitas_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_fasilitas_resource');
    }

    public function update(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('update_fasilitas_resource');
    }

    public function delete(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('delete_fasilitas_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_fasilitas_resource');
    }

    public function restore(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('restore_fasilitas_resource');
    }

    public function forceDelete(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('force_delete_fasilitas_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_fasilitas_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_fasilitas_resource');
    }

    public function replicate(AuthUser $authUser, Fasilitas $fasilitas): bool
    {
        return $authUser->can('replicate_fasilitas_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_fasilitas_resource');
    }

}