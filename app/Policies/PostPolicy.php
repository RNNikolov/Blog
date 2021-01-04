<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user has enough permissions.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function permission(User $user, Post $post)
    {
        return ($user->id === $post->user_id) || (auth()->user()->hasRole('Admin')) || (auth()->user()->hasRole('Editor'));
    }

}
