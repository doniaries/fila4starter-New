<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StatistikSurvey;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatistikSurveyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StatistikSurvey');
    }

    public function view(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('View:StatistikSurvey');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StatistikSurvey');
    }

    public function update(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('Update:StatistikSurvey');
    }

    public function delete(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('Delete:StatistikSurvey');
    }

    public function restore(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('Restore:StatistikSurvey');
    }

    public function forceDelete(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('ForceDelete:StatistikSurvey');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StatistikSurvey');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StatistikSurvey');
    }

    public function replicate(AuthUser $authUser, StatistikSurvey $statistikSurvey): bool
    {
        return $authUser->can('Replicate:StatistikSurvey');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StatistikSurvey');
    }

}