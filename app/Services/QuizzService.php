<?php

namespace App\Services;

use App\Contracts\IQuizzService;
use App\Http\Resources\DailyQuizzResource;
use App\Models\DailyQuizz;
use Carbon\Carbon;

class QuizzService implements IQuizzService
{
    public function getDailyQuizz(): ?DailyQuizzResource
    {
        // On charge toutes les relations du quizz.
        $quizz = DailyQuizz::with([
            'quizz.difficulty',
            'quizz.questions.answers',
            'quizz.questions.difficulty'
        ])
        ->whereDate('scheduled_date', Carbon::now())
        ->first();

        if(!$quizz) {
            return null;
        }

        return new DailyQuizzResource($quizz);
    }
}