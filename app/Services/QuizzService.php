<?php

namespace App\Services;

use App\Contracts\IQuizzService;
use App\Models\Answer;
use App\Models\DailyQuizz;
use App\Models\DailyQuizzUser;
use App\Models\Login;
use App\Models\User;
use Carbon\Carbon;

class QuizzService implements IQuizzService
{
    public int $xpEndQuizz = 10;

    public function __construct(private UserService $xpService)
    {
    }

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

    public function getQuizzById(string $uuid)
    {
        $quizz = DailyQuizz::with([
            'quizz.difficulty',
            'quizz.questions.answers',
            'quizz.questions.difficulty'
        ])
        ->find($uuid);

        return $quizz;
    }

    public function submitQuizz(Login $login, string $dailyQuizzId, array $data)
    {
        $already = $login->user->completedDailyQuizzes()->where('daily_quizz_id', $dailyQuizzId)->first();

        if($already) {
            throw new \Exception("Module déjà complété.");
        }

        $score = 0;
        $totalQuestions = count($data['answers']);
        $xpMax = DailyQuizz::find($dailyQuizzId)->quizz->xp_reward - $this->xpEndQuizz;

        foreach($data['answers'] as $userAnswer) {
            $isCorrect = Answer::where('id', $userAnswer['answerId'])
                ->where('is_correct', true)
                ->exists();

            if($isCorrect) $score ++;
        }

        $reward = $this->calculateXpQuizz($score, $totalQuestions, $xpMax);

        $login->user->completedDailyQuizzes()->attach($dailyQuizzId, [
            'time_spent' => $data['time_spent'],
            'score'      => $score,
            'xp_earned'  => $reward,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Ajoute l'xp à l'utilisateur.
        $this->xpService->addXp($reward);

        return [
            'score' => $score,
            'total' => $totalQuestions,
            'xp'    => $reward
        ];
    }

   public function getFinishedQuizzesIdsForMonth(Login $login, int $month, int $year): array
    {
        return DailyQuizzUser::where('user_id', $login->user->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->pluck('daily_quizz_id')
            ->toArray();
    }

    /**
     * Logique de gains d'xp pour les quizz.
     * Par défaut, on à un nombre d'xp max.
     * Chaque mauvais réponse enlève un %
     * @return integer
     */
    private function calculateXpQuizz(int $score, int $totalQuestions, int $xpMax): int
    {
        $penaltyPerMistake = $xpMax / $totalQuestions;
        $finalXpEarn = $xpMax - ( $penaltyPerMistake * ($totalQuestions - $score));
        return max(0, (int) round($finalXpEarn)) + $this->xpEndQuizz;
    }
}