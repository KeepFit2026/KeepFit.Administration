<?php

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $service = app(AuthServiceInterface::class);
            $token = session('auth');

            if ($token) {
                $userPayload = $service->getTokenPayload($token)['AccountId'] ?? null;
                $currentUser = $userPayload ? User::findNameByAccountId($userPayload) : null;
            } else {
                $currentUser = null;
            }

            $view->with('currentUser', $currentUser);
        });
    }
}