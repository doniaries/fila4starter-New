<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Homestay;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomestayPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Homestay');
    }

    public function view(AuthUser $authUser, Homestay $homestay): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:Homestay') && $homestay->user_id === $authUser->id;
        }
        return $authUser->can('View:Homestay');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Homestay');
    }

    public function update(AuthUser $authUser, Homestay $homestay): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:Homestay') && $homestay->user_id === $authUser->id;
        }
        return $authUser->can('Update:Homestay');
    }

    public function delete(AuthUser $authUser, Homestay $homestay): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:Homestay') && $homestay->user_id === $authUser->id;
        }
        return $authUser->can('Delete:Homestay');
    }

    public function restore(AuthUser $authUser, Homestay $homestay): bool
    {
        return $authUser->can('Restore:Homestay');
    }

    public function forceDelete(AuthUser $authUser, Homestay $homestay): bool
    {
        return $authUser->can('ForceDelete:Homestay');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Homestay');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Homestay');
    }

    public function replicate(AuthUser $authUser, Homestay $homestay): bool
    {
        return $authUser->can('Replicate:Homestay');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Homestay');
    }
}
