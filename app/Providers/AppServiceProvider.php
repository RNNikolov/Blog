<?php

namespace App\Providers;

use App\ExchangeRate;
use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);

        $this->app->bind(ExchangeRate::class, function ($app) {
            return new ExchangeRate();
        });
    }
}
