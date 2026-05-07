<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyQuizzResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'scheduled_date' => $this->scheduled_date,
            'quizz' => new QuizzResource($this->whenLoaded('quizz')),
        ];
    }
}
