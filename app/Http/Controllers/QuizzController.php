<?php

namespace App\Http\Controllers;

use App\Services\QuizzService;

class QuizzController extends Controller
{
    public function __construct(private QuizzService $service)
    {

    }

    public function showToday()
    {
        $quizz = $this->service->getDailyQuizz();
        if(!$quizz) {
            return response()->json([
                'message' => "Aucun Quizz Aujourd'hui"
            ], 404);
        }

        return $quizz;
    }
}
