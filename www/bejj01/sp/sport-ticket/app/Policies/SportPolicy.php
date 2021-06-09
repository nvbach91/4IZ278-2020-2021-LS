<?php

namespace App\Policies;

use App\Models\Sport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // only admins can create new sports
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sport  $sport
     * @return mixed
     */
    public function update(User $user, Sport $sport)
    {
        // only admins can update sports
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sport  $sport
     * @return mixed
     */
    public function delete(User $user, Sport $sport)
    {
        // only admins can delete sports
        return $user->is_admin;
    }
}
