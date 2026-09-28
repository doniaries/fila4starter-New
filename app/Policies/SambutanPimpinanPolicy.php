<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SambutanPimpinan;
use Illuminate\Auth\Access\HandlesAuthorization;

class SambutanPimpinanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SambutanPimpinan');
    }

    public function view(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('View:SambutanPimpinan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SambutanPimpinan');
    }

    public function update(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('Update:SambutanPimpinan');
    }

    public function delete(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('Delete:SambutanPimpinan');
    }

    public function restore(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('Restore:SambutanPimpinan');
    }

    public function forceDelete(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('ForceDelete:SambutanPimpinan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SambutanPimpinan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SambutanPimpinan');
    }

    public function replicate(AuthUser $authUser, SambutanPimpinan $sambutanPimpinan): bool
    {
        return $authUser->can('Replicate:SambutanPimpinan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SambutanPimpinan');
    }

}