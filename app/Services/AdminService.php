<?php

namespace App\Services;

use App\Contracts\AdminServiceInterface;
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
            'email' => 'root@gmail.com',
            'password' => bcrypt('rootroot')
        ]);
    }
}