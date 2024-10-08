<?php

namespace App\Providers;

use App\Events\RegisterEvent;
use App\Listeners\SendWelcomeToRegisterdUser;
use Illuminate\Support\ServiceProvider;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }



    protected $listen =[
        RegisterEvent::class=>[
             SendWelcomeToRegisterdUser::class,
        ]
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);



    }
}
