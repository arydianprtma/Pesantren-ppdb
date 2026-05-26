<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WebSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_web_setting_resource');
    }

    public function view(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('view_web_setting_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_web_setting_resource');
    }

    public function update(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('update_web_setting_resource');
    }

    public function delete(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('delete_web_setting_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_web_setting_resource');
    }

    public function restore(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('restore_web_setting_resource');
    }

    public function forceDelete(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('force_delete_web_setting_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_web_setting_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_web_setting_resource');
    }

    public function replicate(AuthUser $authUser, WebSetting $webSetting): bool
    {
        return $authUser->can('replicate_web_setting_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_web_setting_resource');
    }

}