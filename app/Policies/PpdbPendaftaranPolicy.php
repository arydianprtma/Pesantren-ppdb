<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PpdbPendaftaran;
use Illuminate\Auth\Access\HandlesAuthorization;

class PpdbPendaftaranPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_ppdb_registrant_resource');
    }

    public function view(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('view_ppdb_registrant_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_ppdb_registrant_resource');
    }

    public function update(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('update_ppdb_registrant_resource');
    }

    public function delete(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('delete_ppdb_registrant_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_ppdb_registrant_resource');
    }

    public function restore(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('restore_ppdb_registrant_resource');
    }

    public function forceDelete(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('force_delete_ppdb_registrant_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_ppdb_registrant_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_ppdb_registrant_resource');
    }

    public function replicate(AuthUser $authUser, PpdbPendaftaran $ppdbPendaftaran): bool
    {
        return $authUser->can('replicate_ppdb_registrant_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_ppdb_registrant_resource');
    }

}