<?php

namespace App\Policies;

use App\Models\User;
use App\ProjectSpace;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectSpacePolicy
{
    use HandlesAuthorization;

    public function view(User $user, ProjectSpace $project_space)
    {
        return $project_space->users->contains($user);
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=App\Project  $project
     * @return mixed
     */
    public function update(User $user, ProjectSpace $project_space)
    {
        //
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=App\Project  $project
     * @return mixed
     */
    public function delete(User $user, ProjectSpace $project)
    {
        //
    }
}
