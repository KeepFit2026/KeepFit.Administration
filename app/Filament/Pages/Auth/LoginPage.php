<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as PagesLogin;

class LoginPage extends PagesLogin
{
    protected string $view = 'filament.pages.auth.login';

    protected static string $layout = 'Layouts.login';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
