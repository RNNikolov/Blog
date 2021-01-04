<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Defining gates

        Gate::define('manage-posts-comments', function ($user) {
            return ($user->hasRole('Admin') || $user->hasRole('Editor'));
        });

        Gate::define('manage-roles', function ($user) {
            return $user->hasRole('Admin');
        });

        Gate::define('denied-access', function ($postId) {
            $post = Post::find($postId);
            if ((auth()->user()->id == $post->user->id) || (auth()->user()->hasRole('Admin')) || (auth()->user()->hasRole('Editor'))) {
                return true;
            }

            return false;
        });

    }
}
