<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\KategoriWisata;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriWisataPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:KategoriWisata');
    }

    public function view(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('View:KategoriWisata');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:KategoriWisata');
    }

    public function update(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('Update:KategoriWisata');
    }

    public function delete(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('Delete:KategoriWisata');
    }

    public function restore(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('Restore:KategoriWisata');
    }

    public function forceDelete(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('ForceDelete:KategoriWisata');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:KategoriWisata');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:KategoriWisata');
    }

    public function replicate(AuthUser $authUser, KategoriWisata $kategoriWisata): bool
    {
        return $authUser->can('Replicate:KategoriWisata');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:KategoriWisata');
    }

}