<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Berita;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeritaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_berita_resource');
    }

    public function view(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('view_berita_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_berita_resource');
    }

    public function update(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('update_berita_resource');
    }

    public function delete(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('delete_berita_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_berita_resource');
    }

    public function restore(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('restore_berita_resource');
    }

    public function forceDelete(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('force_delete_berita_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_berita_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_berita_resource');
    }

    public function replicate(AuthUser $authUser, Berita $berita): bool
    {
        return $authUser->can('replicate_berita_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_berita_resource');
    }

}