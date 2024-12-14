<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

use App\CustomChatify\CustomChatifyMessenger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('custom-chatify', function () {
            return new CustomChatifyMessenger();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if('notadmin', function () {
            return Auth::check() && !Auth::user()->isAdmin();
        });
    }
}
