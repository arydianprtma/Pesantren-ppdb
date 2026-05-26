<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Agenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_agenda_resource');
    }

    public function view(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('view_agenda_resource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_agenda_resource');
    }

    public function update(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('update_agenda_resource');
    }

    public function delete(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('delete_agenda_resource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_agenda_resource');
    }

    public function restore(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('restore_agenda_resource');
    }

    public function forceDelete(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('force_delete_agenda_resource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_agenda_resource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_agenda_resource');
    }

    public function replicate(AuthUser $authUser, Agenda $agenda): bool
    {
        return $authUser->can('replicate_agenda_resource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_agenda_resource');
    }

}