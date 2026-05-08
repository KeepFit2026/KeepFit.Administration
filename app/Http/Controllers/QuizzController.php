<?php

namespace App\Http\Controllers;

use App\Services\QuizzService;
use App\Http\Resources\DailyQuizzResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function __construct(private QuizzService $service)
    {

    }

    public function showToday(): JsonResponse|DailyQuizzResource
    {
        $quizz = $this->service->getDailyQuizz();

        if(!$quizz) {
            return response()->json([
                'message' => "Aucun Quizz Aujourd'hui"
            ], 404);
        }

        return new DailyQuizzResource($quizz);
    }

    public function getQuizzByDate(Request $request): JsonResponse|DailyQuizzResource
    {
        $date = $request->input('date');

        if(!$date) {
            return response()->json([
                'message' => "Le paramètre 'date' est requis."
            ], 400);
        }

        $quizz = $this->service->getQuizzByDate($date);

        if(!$quizz) {
            return response()->json([
                'message' => "Aucun Quizz trouvé pour la date du $date"
            ], 404);
        }

        return new DailyQuizzResource($quizz);
    }
}