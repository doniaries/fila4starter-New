<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StrukturOrganisasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class StrukturOrganisasiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StrukturOrganisasi');
    }

    public function view(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('View:StrukturOrganisasi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StrukturOrganisasi');
    }

    public function update(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('Update:StrukturOrganisasi');
    }

    public function delete(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('Delete:StrukturOrganisasi');
    }

    public function restore(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('Restore:StrukturOrganisasi');
    }

    public function forceDelete(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('ForceDelete:StrukturOrganisasi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StrukturOrganisasi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StrukturOrganisasi');
    }

    public function replicate(AuthUser $authUser, StrukturOrganisasi $strukturOrganisasi): bool
    {
        return $authUser->can('Replicate:StrukturOrganisasi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StrukturOrganisasi');
    }

}