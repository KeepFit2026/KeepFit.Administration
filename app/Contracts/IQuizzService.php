<?php

namespace App\Contracts;

use App\Http\Resources\DailyQuizzResource;
use App\Models\Login;
use Illuminate\Support\Facades\Date;

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

    /**
     * Récupère un quizz en fonction de son ID
     * @param string $uuid Id du quizz.
     */
    public function getQuizzById(string $uuid);

    /**
     * Enregistrement du résultat
     * @param Login $login L'utilisateur connecté
     * @param string $dailyQuizzId L'id du quizz
     * @param array $data les statistiques / Les réponses de l'utilisateur
     */
    public function submitQuizz(Login $login, string $dailyQuizzId, array $data);

    /**
     * Récupère la liste des Ids des Quizz déjà fait dans le mois en cours.
     */
    public function getFinishedQuizzesIdsForMonth(Login $login, int $month, int $year): array;
}
