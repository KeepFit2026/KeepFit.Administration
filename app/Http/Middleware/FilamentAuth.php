<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;

class FilamentAuth extends Middleware
{
    /**
     * Redirige l'utilisateur s'il n'est pas connecté.
     */
    protected function redirectTo($request): ?string
    {
        return env('APP_LOGIN_APP');
    }
}