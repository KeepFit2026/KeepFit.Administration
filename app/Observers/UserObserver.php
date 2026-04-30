<?php

namespace App\Observers;

use App\Models\Level;
use App\Models\User;
use App\Services\UserService;

class UserObserver
{
    public function __construct(private UserService $service)
    {

    }
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

            $current_level_number = $user->level?->number ?? 0;
            $next_level_number = $current_level_number + 2;

            // Si le prochain niveau n'existe pas encore en base
            if(!Level::where('number', $next_level_number)->exists()) {
                Level::create([
                    'id'          => (string) \Str::uuid(),
                    'number'      => $next_level_number,
                    'required_xp' => $this->service->calculateRequiredXp($next_level_number)
                ]);
            }
        }
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
