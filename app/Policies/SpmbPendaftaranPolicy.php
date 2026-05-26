<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SpmbPendaftaran;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpmbPendaftaranPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_spmb_registrant_resource');
    }

    public function view(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('view_spmb_registrant_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_spmb_registrant_resource');
    }

    public function update(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('update_spmb_registrant_resource');
    }

    public function delete(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('delete_spmb_registrant_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_spmb_registrant_resource');
    }

    public function restore(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('restore_spmb_registrant_resource');
    }

    public function forceDelete(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('force_delete_spmb_registrant_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_spmb_registrant_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_spmb_registrant_resource');
    }

    public function replicate(AuthUser $authUser, SpmbPendaftaran $spmbPendaftaran): bool
    {
        return $authUser->can('replicate_spmb_registrant_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_spmb_registrant_resource');
    }

}