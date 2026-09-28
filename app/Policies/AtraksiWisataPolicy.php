<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AtraksiWisata;
use Illuminate\Auth\Access\HandlesAuthorization;

class AtraksiWisataPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AtraksiWisata');
    }

    public function view(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:AtraksiWisata') && $atraksiWisata->user_id === $authUser->id;
        }
        return $authUser->can('View:AtraksiWisata');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AtraksiWisata');
    }

    public function update(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:AtraksiWisata') && $atraksiWisata->user_id === $authUser->id;
        }
        return $authUser->can('Update:AtraksiWisata');
    }

    public function delete(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:AtraksiWisata') && $atraksiWisata->user_id === $authUser->id;
        }
        return $authUser->can('Delete:AtraksiWisata');
    }

    public function restore(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        return $authUser->can('Restore:AtraksiWisata');
    }

    public function forceDelete(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        return $authUser->can('ForceDelete:AtraksiWisata');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AtraksiWisata');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AtraksiWisata');
    }

    public function replicate(AuthUser $authUser, AtraksiWisata $atraksiWisata): bool
    {
        return $authUser->can('Replicate:AtraksiWisata');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AtraksiWisata');
    }
}
