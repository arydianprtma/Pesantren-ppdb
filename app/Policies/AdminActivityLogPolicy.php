<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AdminActivityLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminActivityLogPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_activity_log_resource');
    }

    public function view(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('view_activity_log_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_activity_log_resource');
    }

    public function update(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('update_activity_log_resource');
    }

    public function delete(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('delete_activity_log_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_activity_log_resource');
    }

    public function restore(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('restore_activity_log_resource');
    }

    public function forceDelete(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('force_delete_activity_log_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_activity_log_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_activity_log_resource');
    }

    public function replicate(AuthUser $authUser, AdminActivityLog $adminActivityLog): bool
    {
        return $authUser->can('replicate_activity_log_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_activity_log_resource');
    }

}