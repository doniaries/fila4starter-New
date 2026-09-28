<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kuliner;
use Illuminate\Auth\Access\HandlesAuthorization;

class KulinerPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Kuliner');
    }

    public function view(AuthUser $authUser, Kuliner $kuliner): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('View:Kuliner') && $kuliner->user_id === $authUser->id;
        }
        return $authUser->can('View:Kuliner');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Kuliner');
    }

    public function update(AuthUser $authUser, Kuliner $kuliner): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Update:Kuliner') && $kuliner->user_id === $authUser->id;
        }
        return $authUser->can('Update:Kuliner');
    }

    public function delete(AuthUser $authUser, Kuliner $kuliner): bool
    {
        if ($authUser->hasRole('pengelola_wisata')) {
            return $authUser->can('Delete:Kuliner') && $kuliner->user_id === $authUser->id;
        }
        return $authUser->can('Delete:Kuliner');
    }

    public function restore(AuthUser $authUser, Kuliner $kuliner): bool
    {
        return $authUser->can('Restore:Kuliner');
    }

    public function forceDelete(AuthUser $authUser, Kuliner $kuliner): bool
    {
        return $authUser->can('ForceDelete:Kuliner');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Kuliner');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Kuliner');
    }

    public function replicate(AuthUser $authUser, Kuliner $kuliner): bool
    {
        return $authUser->can('Replicate:Kuliner');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Kuliner');
    }
}
