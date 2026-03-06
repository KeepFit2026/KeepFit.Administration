<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;
use App\Models\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService implements AuthServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getLogin(array $data): Login|null
    {
        $user = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
            ]);

        if($user) return Auth::guard('web')->user();
        return null;
    }

    public function register(array $data, string $uuid): bool
    {
        return DB::transaction(function () use ($data, $uuid) {
            $user = User::create([
                'name' => $data['name'],
                'account_id' => $uuid
            ]);

            Login::where('id', $uuid)->update([
                'email_verified_at' => now()
            ]);

            return (bool) $user;
        });
    }
}
