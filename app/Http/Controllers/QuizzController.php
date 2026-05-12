<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizzRequest;
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

    public function show(string $uuid): JsonResponse|DailyQuizzResource
    {
        $quizz = $this->service->getQuizzById($uuid);

        if(!$quizz) {
            return response()->json([
                'message' => "Aucun Quizz"
            ], 404);
        }

        return new DailyQuizzResource($quizz);
    }

    public function submitQuizz(QuizzRequest $request, string $dailyQuizzId)
    {
        $validated = $request->validated();
        $result = $this->service->submitQuizz($request->user(), $dailyQuizzId, $validated);

        return response()->json([
            'status' => 'success',
            'data' => $result
        ], 201);
    }

    public function monthlyStatus(Request $request): JsonResponse
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year'  => 'required|integer',
        ]);

        $ids = $this->service->getFinishedQuizzesIdsForMonth(
            $request->user(),
            $request->query('month'),
            $request->query('year')
        );

        return response()->json([
            'status' => 'success',
            'finished_ids' => $ids
        ]);
    }
}