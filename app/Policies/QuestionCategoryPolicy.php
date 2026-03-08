<?php

namespace App\Policies;

use App\Models\User;
use App\Models\QuestionCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_question_category');
    }

    public function view(User $user, QuestionCategory $model): bool
    {
        return $user->can('view_question_category');
    }

    public function create(User $user): bool
    {
        return $user->can('create_question_category');
    }

    public function update(User $user, QuestionCategory $model): bool
    {
        return $user->can('update_question_category');
    }

    public function delete(User $user, QuestionCategory $model): bool
    {
        return $user->can('delete_question_category');
    }
}
