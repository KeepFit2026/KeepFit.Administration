<?php

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Models\Login;
use App\Services\AuthService;
use Filament\Actions\Exports\Jobs\ExportCsv;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
