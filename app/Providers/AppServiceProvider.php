<?php

namespace App\Providers;

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
        // The admin panel is built on Bootstrap, not Tailwind, so pagination
        // links need Bootstrap markup or they render unstyled/broken.
        Paginator::useBootstrapFive();
    }
}
