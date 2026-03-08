<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Signer;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_signer');
    }

    public function view(User $user, Signer $model): bool
    {
        return $user->can('view_signer');
    }

    public function create(User $user): bool
    {
        return $user->can('create_signer');
    }

    public function update(User $user, Signer $model): bool
    {
        return $user->can('update_signer');
    }

    public function delete(User $user, Signer $model): bool
    {
        return $user->can('delete_signer');
    }
}
