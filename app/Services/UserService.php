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

    /**
     * Ajoute de l'expérience à un utilisateur
     * @param integer $amount le nombre d'expérience
    */
    public function addXp(int $amount): void
    {
        $profile = User::where('account_id', Auth::id())->first();

        if ($profile) {
            $level = Level::where('number', $profile->level->number + 1)->first(); // Trouve le niveau de l'utilisateur
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
            $profile->current_level = $level->id; //Prends la référence du nouveau niveau de l'utilisateur.
            $profile->current_xp = 0;
        }
    }

    /**
     * Associe un nombre d'expérience à un niveau
     * @param integer $level le numéro du niveau
     * @return integer le nombre d'xp du niveau
    */
    public function calculateRequiredXp(int $level): int
    {
        $baseXp = 100;
        return (int) round($baseXp * pow($level, 1.5));
    }

}
