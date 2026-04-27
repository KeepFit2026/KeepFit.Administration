<?php

namespace App\Http\Resources;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //Si l'utlisateur existe.
        if($this->user) {
            $nextLevelUser = $this->user->current_level + 1; //On trouve le prochain niveau.
            $nextLevel = Level::where('number', $nextLevelUser)->first();
        }

        return [
            'id'                   => $this->id,
            'name'                 => $this->user->name ?? 'Inconnu',
            'email'                => $this->email,
            'onboarding_completed' => $this->onboarding_completed,
            'current_level'        => $this->user->current_level,
            'xp_required'          => $nextLevel->required_xp ?? 0,
            'current_xp'           => $this->user->current_xp
        ];
    }
}
