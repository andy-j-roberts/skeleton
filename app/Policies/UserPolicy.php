<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function view(User $user, User $model)
    {

    }

    public function create(User $user)
    {
        return $user->hasRole('Admin');
    }

    public function update(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->id == $model->id;
    }
}
