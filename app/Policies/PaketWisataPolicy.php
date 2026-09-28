<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PaketWisata;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaketWisataPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PaketWisata');
    }

    public function view(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:PaketWisata') && $paketWisata->user_id === $authUser->id;
        }
        return $authUser->can('View:PaketWisata');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PaketWisata');
    }

    public function update(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:PaketWisata') && $paketWisata->user_id === $authUser->id;
        }
        return $authUser->can('Update:PaketWisata');
    }

    public function delete(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:PaketWisata') && $paketWisata->user_id === $authUser->id;
        }
        return $authUser->can('Delete:PaketWisata');
    }

    public function restore(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        return $authUser->can('Restore:PaketWisata');
    }

    public function forceDelete(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        return $authUser->can('ForceDelete:PaketWisata');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PaketWisata');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PaketWisata');
    }

    public function replicate(AuthUser $authUser, PaketWisata $paketWisata): bool
    {
        return $authUser->can('Replicate:PaketWisata');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PaketWisata');
    }
}
