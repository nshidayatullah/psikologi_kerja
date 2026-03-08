<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_question');
    }

    public function view(User $user, Question $model): bool
    {
        return $user->can('view_question');
    }

    public function create(User $user): bool
    {
        return $user->can('create_question');
    }

    public function update(User $user, Question $model): bool
    {
        return $user->can('update_question');
    }

    public function delete(User $user, Question $model): bool
    {
        return $user->can('delete_question');
    }
}
