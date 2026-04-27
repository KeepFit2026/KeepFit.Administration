<?php

namespace App\Observers;

use App\Models\Level;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if($user->wasChanged('current_level')) {
            $next_level_number = $user->current_level + 1; // On récup le niveau suivant.

            //Si le prochain niveau n'existe pas encore
            if(!(Level::where('number', $next_level_number))->exists()) {
                Level::create([
                    'number'      => $next_level_number,
                    'required_xp' => $this->calculateRequiredXp($next_level_number)
                ]);
            }
        }
    }

    private function calculateRequiredXp(int $level): int
    {
        $baseXp = 100;
        return (int) round($baseXp * pow($level, 1.5));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
