<?php

namespace App\Providers;

use App\Services\Impl\TodoServiceImpl;
use App\Services\TodoService;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides()
    {
        return [
            TodoService::class
        ];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TodoService::class, TodoServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
