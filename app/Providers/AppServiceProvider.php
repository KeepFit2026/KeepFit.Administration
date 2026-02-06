<?php

namespace App\Providers;

use App\Contracts\AdminServiceInterface;
use App\Contracts\AuthServiceInterface;
use App\Http\Responses\LogoutResponse;
use App\Services\AdminService;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
