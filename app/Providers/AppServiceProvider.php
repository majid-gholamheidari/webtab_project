<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use App\Observers\LogObserver;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Admin::observe(LogObserver::class);
        User::observe(LogObserver::class);
        Comment::observe(LogObserver::class);
    }
}
