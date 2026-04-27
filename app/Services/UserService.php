<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function getCurrentUser()
    {
        Log::info(Auth::user());
        return new UserResource(Auth::user());
    }

    public function addXp(int $amount)
    {
        $profile = User::where('account_id', Auth::id())->first();

        if ($profile) {
            $profile->current_xp += $amount;
            $profile->save();
        }
    }
}
