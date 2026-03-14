<?php

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Models\Login;
use App\Services\AuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        // Indique à Laravel / Filament que le modèle authentifiable par défaut est Login
        $this->app->bind(Authenticatable::class, Login::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
