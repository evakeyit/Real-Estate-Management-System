<?php

namespace App\Providers;

use App\Services\DatabaseBootstrap;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        if (! $this->app->runningInConsole()) {
            DatabaseBootstrap::ensureDatabaseExists();
            DatabaseBootstrap::runMigrationsIfNeeded();
        }
    }
}
