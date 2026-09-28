<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SurveyWisata;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyWisataPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SurveyWisata');
    }

    public function view(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('View:SurveyWisata');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SurveyWisata');
    }

    public function update(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('Update:SurveyWisata');
    }

    public function delete(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('Delete:SurveyWisata');
    }

    public function restore(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('Restore:SurveyWisata');
    }

    public function forceDelete(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('ForceDelete:SurveyWisata');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SurveyWisata');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SurveyWisata');
    }

    public function replicate(AuthUser $authUser, SurveyWisata $surveyWisata): bool
    {
        return $authUser->can('Replicate:SurveyWisata');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SurveyWisata');
    }

}