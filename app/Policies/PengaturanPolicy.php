<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pengaturan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengaturanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pengaturan');
    }

    public function view(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('View:Pengaturan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pengaturan');
    }

    public function update(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('Update:Pengaturan');
    }

    public function delete(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('Delete:Pengaturan');
    }

    public function restore(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('Restore:Pengaturan');
    }

    public function forceDelete(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('ForceDelete:Pengaturan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pengaturan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pengaturan');
    }

    public function replicate(AuthUser $authUser, Pengaturan $pengaturan): bool
    {
        return $authUser->can('Replicate:Pengaturan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pengaturan');
    }

}