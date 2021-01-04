<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user has enough permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function userCheck(User $user, Profile $profile)
    {
        return ($user->id === $profile->user_id);
    }
}
