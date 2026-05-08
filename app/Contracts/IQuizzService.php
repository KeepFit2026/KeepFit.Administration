<?php

namespace App\Contracts;

use App\Http\Resources\DailyQuizzResource;

interface IQuizzService
{
    /**
     * Récupère un quizz quotidien.
     */
    public function getDailyQuizz();

    /**
     * Récupère le quizz d'une certaine date
     *
     * @param string $date la date
     * @return DailyQuizzResource|null
     */
    public function getQuizzByDate(string $date);
}
