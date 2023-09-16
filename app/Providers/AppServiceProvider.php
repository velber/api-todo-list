<?php

namespace App\Providers;

use App\Repositories\TasksRepository;
use App\Repositories\Contracts\TasksRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TasksRepositoryInterface::class, TasksRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
