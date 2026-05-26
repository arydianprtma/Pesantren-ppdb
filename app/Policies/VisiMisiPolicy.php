<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VisiMisi;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisiMisiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_visi_misi_resource');
    }

    public function view(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('view_visi_misi_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_visi_misi_resource');
    }

    public function update(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('update_visi_misi_resource');
    }

    public function delete(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('delete_visi_misi_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_visi_misi_resource');
    }

    public function restore(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('restore_visi_misi_resource');
    }

    public function forceDelete(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('force_delete_visi_misi_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_visi_misi_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_visi_misi_resource');
    }

    public function replicate(AuthUser $authUser, VisiMisi $visiMisi): bool
    {
        return $authUser->can('replicate_visi_misi_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_visi_misi_resource');
    }

}