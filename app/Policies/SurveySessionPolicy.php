<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SurveySession;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveySessionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_survey_session');
    }

    public function view(User $user, SurveySession $surveySession): bool
    {
        return $user->can('view_survey_session');
    }

    public function create(User $user): bool
    {
        return $user->can('create_survey_session');
    }

    public function update(User $user, SurveySession $surveySession): bool
    {
        return $user->can('update_survey_session');
    }

    public function delete(User $user, SurveySession $surveySession): bool
    {
        return $user->can('delete_survey_session');
    }
}
