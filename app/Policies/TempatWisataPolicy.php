<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TempatWisata;
use Illuminate\Auth\Access\HandlesAuthorization;

class TempatWisataPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TempatWisata');
    }

    public function view(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:TempatWisata') && $tempatWisata->user_id === $authUser->id;
        }
        return $authUser->can('View:TempatWisata');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TempatWisata');
    }

    public function update(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:TempatWisata') && $tempatWisata->user_id === $authUser->id;
        }
        return $authUser->can('Update:TempatWisata');
    }

    public function delete(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:TempatWisata') && $tempatWisata->user_id === $authUser->id;
        }
        return $authUser->can('Delete:TempatWisata');
    }

    public function restore(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        return $authUser->can('Restore:TempatWisata');
    }

    public function forceDelete(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        return $authUser->can('ForceDelete:TempatWisata');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TempatWisata');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TempatWisata');
    }

    public function replicate(AuthUser $authUser, TempatWisata $tempatWisata): bool
    {
        return $authUser->can('Replicate:TempatWisata');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TempatWisata');
    }
}
