<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Data;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Data');
    }

    public function view(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('View:Data');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Data');
    }

    public function update(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('Update:Data');
    }

    public function delete(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('Delete:Data');
    }

    public function restore(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('Restore:Data');
    }

    public function forceDelete(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('ForceDelete:Data');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Data');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Data');
    }

    public function replicate(AuthUser $authUser, Data $data): bool
    {
        return $authUser->can('Replicate:Data');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Data');
    }
}
