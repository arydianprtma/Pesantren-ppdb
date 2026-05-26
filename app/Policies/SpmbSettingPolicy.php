<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SpmbSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpmbSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_spmb_setting_resource');
    }

    public function view(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('view_spmb_setting_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_spmb_setting_resource');
    }

    public function update(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('update_spmb_setting_resource');
    }

    public function delete(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('delete_spmb_setting_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_spmb_setting_resource');
    }

    public function restore(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('restore_spmb_setting_resource');
    }

    public function forceDelete(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('force_delete_spmb_setting_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_spmb_setting_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_spmb_setting_resource');
    }

    public function replicate(AuthUser $authUser, SpmbSetting $spmbSetting): bool
    {
        return $authUser->can('replicate_spmb_setting_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_spmb_setting_resource');
    }

}