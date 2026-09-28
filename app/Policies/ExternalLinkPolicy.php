<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ExternalLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExternalLinkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ExternalLink');
    }

    public function view(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('View:ExternalLink');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ExternalLink');
    }

    public function update(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('Update:ExternalLink');
    }

    public function delete(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('Delete:ExternalLink');
    }

    public function restore(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('Restore:ExternalLink');
    }

    public function forceDelete(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('ForceDelete:ExternalLink');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ExternalLink');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ExternalLink');
    }

    public function replicate(AuthUser $authUser, ExternalLink $externalLink): bool
    {
        return $authUser->can('Replicate:ExternalLink');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ExternalLink');
    }

}