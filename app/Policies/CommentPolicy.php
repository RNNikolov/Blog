<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user has enough permissions.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function permission(User $user, Comment $comment)
    {
        return ($user->id === $comment->post->user_id) || (auth()->user()->hasRole('Admin')) || (auth()->user()->hasRole('Editor'));
    }
}
