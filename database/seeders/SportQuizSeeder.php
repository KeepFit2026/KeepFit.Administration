<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\Question;
use App\Models\DailyQuizz;
use App\Models\Quizz;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SportQuizSeeder extends Seeder
{
    public function run(): void
    {
        $diffFacile = Difficulty::where('name', 'Facile')->first()->id;
        $diffMoyen = Difficulty::where('name', 'Moyen')->first()->id;
        $diffDifficile = Difficulty::where('name', 'Difficile')->first()->id;

        $quizzesData = [
            [
                'title' => 'Quiz Football : Les bases',
                'description' => 'Testez vos connaissances sur les règles fondamentales du football.',
                'difficulty_id' => $diffFacile,
                'schedule_offset' => -1,
                'questions' => [
                    [
                        'content' => 'Combien de joueurs composent une équipe de football sur le terrain ?',
                        'difficulty_id' => $diffFacile,
                        'answers' => [
                            ['content' => '11 joueurs', 'is_correct' => true],
                            ['content' => '9 joueurs', 'is_correct' => false],
                            ['content' => '10 joueurs', 'is_correct' => false],
                            ['content' => '12 joueurs', 'is_correct' => false],
                        ]
                    ],
                    [
                        'content' => 'Quelle est la durée réglementaire d\'un match de football ?',
                        'difficulty_id' => $diffFacile,
                        'answers' => [
                            ['content' => '90 minutes', 'is_correct' => true],
                            ['content' => '80 minutes', 'is_correct' => false],
                            ['content' => '100 minutes', 'is_correct' => false],
                            ['content' => '120 minutes', 'is_correct' => false],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Légendes du Tennis',
                'description' => 'Un quiz pour les vrais passionnés de la petite balle jaune.',
                'difficulty_id' => $diffMoyen,
                'schedule_offset' => 0,
                'questions' => [
                    [
                        'content' => 'Quel joueur détient le record du nombre de semaines passées à la place de numéro 1 mondial ?',
                        'difficulty_id' => $diffMoyen,
                        'answers' => [
                            ['content' => 'Novak Djokovic', 'is_correct' => true],
                            ['content' => 'Roger Federer', 'is_correct' => false],
                            ['content' => 'Rafael Nadal', 'is_correct' => false],
                            ['content' => 'Pete Sampras', 'is_correct' => false],
                        ]
                    ]
                ]
            ]
        ];

        foreach ($quizzesData as $quizData) {
            $quiz = Quizz::create([
                'title' => $quizData['title'],
                'description' => $quizData['description'],
                'difficulty_id' => $quizData['difficulty_id'],
                'xp_reward' => 100,
            ]);

            foreach ($quizData['questions'] as $questionData) {
                $question = Question::create([
                    'content' => $questionData['content'],
                    'difficulty_id' => $questionData['difficulty_id'],
                ]);

                $quiz->questions()->attach($question->id);

                foreach ($questionData['answers'] as $answerData) {
                    $question->answers()->create([
                        'content' => $answerData['content'],
                        'is_correct' => $answerData['is_correct'],
                    ]);
                }
            }

            DailyQuizz::create([
                'scheduled_date' => Carbon::today()->addDays($quizData['schedule_offset']),
                'quizz_id' => $quiz->id,
            ]);
        }
    }
}