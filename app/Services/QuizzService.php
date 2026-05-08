<?php

namespace App\Services;

use App\Contracts\IQuizzService;
use App\Models\DailyQuizz;
use Carbon\Carbon;

class QuizzService implements IQuizzService
{
    public function getDailyQuizz()
    {
        // On charge toutes les relations du quizz.
        $quizz = DailyQuizz::with([
            'quizz.difficulty',
            'quizz.questions.answers',
            'quizz.questions.difficulty'
        ])
        ->whereDate('scheduled_date', Carbon::now())
        ->first();

        return $quizz;
    }

    public function getQuizzByDate(string $date)
    {
        try {
            $dataTime = Carbon::parse($date);
        } catch(\Exception $e) {
            return null;
        }

        // On charge toutes les relations du quizz.
        $quizz = DailyQuizz::with([
            'quizz.difficulty',
            'quizz.questions.answers',
            'quizz.questions.difficulty'
        ])
        ->whereDate('scheduled_date', $dataTime)
        ->first();

        return $quizz;
    }
}