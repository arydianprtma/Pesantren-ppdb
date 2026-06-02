<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PpdbSiswa;
use Illuminate\Auth\Access\HandlesAuthorization;

class PpdbSiswaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_data_siswa_resource');
    }

    public function view(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('view_data_siswa_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_data_siswa_resource');
    }

    public function update(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('update_data_siswa_resource');
    }

    public function delete(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('delete_data_siswa_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_data_siswa_resource');
    }

    public function restore(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('restore_data_siswa_resource');
    }

    public function forceDelete(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('force_delete_data_siswa_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_data_siswa_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_data_siswa_resource');
    }

    public function replicate(AuthUser $authUser, PpdbSiswa $ppdbSiswa): bool
    {
        return $authUser->can('replicate_data_siswa_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_data_siswa_resource');
    }

}