<?php

namespace App\Contracts;

use App\Http\Resources\DailyQuizzResource;

interface IQuizzService
{
    /**
     * Récupère un quizz quotidien.
     */
    public function getDailyQuizz(): ?DailyQuizzResource;
}
