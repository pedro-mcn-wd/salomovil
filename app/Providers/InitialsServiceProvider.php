<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InitialsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Http/Helpers/Initials.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
