<?php

namespace App\Services;

use App\Contracts\AdminServiceInterface;
use App\Contracts\AuthServiceInterface;
use App\Models\Login;

class AdminService implements AdminServiceInterface
{
    /**
     * Temporaire
     *
     * @return void
     */
    public function CreateAccount(): void
    {
        Login::create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password1234')
        ]);
    }
}