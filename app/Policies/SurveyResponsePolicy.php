<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SurveyResponse;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyResponsePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_survey_response');
    }

    public function view(User $user, SurveyResponse $model): bool
    {
        return $user->can('view_survey_response');
    }

    public function create(User $user): bool
    {
        return false; // Typically created publically, not in admin?
    }

    public function update(User $user, SurveyResponse $model): bool
    {
        return $user->can('update_survey_response');
    }

    public function delete(User $user, SurveyResponse $model): bool
    {
        return $user->can('delete_survey_response');
    }
}
