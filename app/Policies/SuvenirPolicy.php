<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Suvenir;
use Illuminate\Auth\Access\HandlesAuthorization;

class SuvenirPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Suvenir');
    }

    public function view(AuthUser $authUser, Suvenir $suvenir): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:Suvenir') && $suvenir->user_id === $authUser->id;
        }
        return $authUser->can('View:Suvenir');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Suvenir');
    }

    public function update(AuthUser $authUser, Suvenir $suvenir): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:Suvenir') && $suvenir->user_id === $authUser->id;
        }
        return $authUser->can('Update:Suvenir');
    }

    public function delete(AuthUser $authUser, Suvenir $suvenir): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:Suvenir') && $suvenir->user_id === $authUser->id;
        }
        return $authUser->can('Delete:Suvenir');
    }

    public function restore(AuthUser $authUser, Suvenir $suvenir): bool
    {
        return $authUser->can('Restore:Suvenir');
    }

    public function forceDelete(AuthUser $authUser, Suvenir $suvenir): bool
    {
        return $authUser->can('ForceDelete:Suvenir');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Suvenir');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Suvenir');
    }

    public function replicate(AuthUser $authUser, Suvenir $suvenir): bool
    {
        return $authUser->can('Replicate:Suvenir');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Suvenir');
    }
}
