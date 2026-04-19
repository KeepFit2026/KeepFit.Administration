<?php

namespace App\Pipelines\Onboarding;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SaveProfileData
{
    public function handle($data, Closure $next)
    {
        try {
            User::updateOrCreate(
                ['account_id' => $data['user']->id], // Condition de recherche
                [
                    'name'           => $data['user']->name ?? 'Élève',
                    'school'         => $data['request']['school'],
                    'grade'          => $data['request']['grade'],
                    'sports_profile' => $data['request']['sports_profile'],
                    'primary_goal'   => $data['request']['primary_goal'],
                ]
            );

            // On passe au tuyau suivant
            return $next($data);

        } catch (\Exception $e) {
            Log::error('Erreur Onboarding (SaveProfileData): ' . $e->getMessage());
            throw new \Exception('Erreur lors de la création du profil sportif.');
        }
    }
}