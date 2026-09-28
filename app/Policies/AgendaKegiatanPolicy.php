<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AgendaKegiatan;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaKegiatanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AgendaKegiatan');
    }

    public function view(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('View:AgendaKegiatan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AgendaKegiatan');
    }

    public function update(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('Update:AgendaKegiatan');
    }

    public function delete(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('Delete:AgendaKegiatan');
    }

    public function restore(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('Restore:AgendaKegiatan');
    }

    public function forceDelete(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('ForceDelete:AgendaKegiatan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AgendaKegiatan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AgendaKegiatan');
    }

    public function replicate(AuthUser $authUser, AgendaKegiatan $agendaKegiatan): bool
    {
        return $authUser->can('Replicate:AgendaKegiatan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AgendaKegiatan');
    }

}