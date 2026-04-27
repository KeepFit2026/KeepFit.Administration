<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getCurrentUser(): UserResource
    {
        return new UserResource(Auth::user());
    }

    public function addXp(int $amount): void
    {
        $profile = User::where('account_id', Auth::id())->first();

        if ($profile) {
            $level = Level::where('number', $profile->current_level + 1)->first(); // Trouve le niveau de l'utilisateur
            $profile->current_xp += $amount;

            $this->nextLevel($level, $profile);

            $profile->save();
        }
    }

    /**
     * Passe l'utilisateur au niveau suivant
     * @return void
     */
    public function nextLevel(Level $level, User $profile): void
    {
        if($profile->current_xp >= $level->required_xp) {
            $profile->current_level += 1;
            $profile->current_xp = 0;
        }
    }
}
