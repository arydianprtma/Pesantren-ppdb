<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ContactMessage;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactMessagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_contact_message_resource');
    }

    public function view(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('view_contact_message_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_contact_message_resource');
    }

    public function update(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('update_contact_message_resource');
    }

    public function delete(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('delete_contact_message_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_contact_message_resource');
    }

    public function restore(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('restore_contact_message_resource');
    }

    public function forceDelete(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('force_delete_contact_message_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_contact_message_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_contact_message_resource');
    }

    public function replicate(AuthUser $authUser, ContactMessage $contactMessage): bool
    {
        return $authUser->can('replicate_contact_message_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_contact_message_resource');
    }

}