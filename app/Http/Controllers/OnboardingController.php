<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnboardingRequest;
use App\Pipelines\Onboarding\MarkAccountAsOnboarded;
use App\Pipelines\Onboarding\SaveProfileData;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Log as FacadesLog;

class OnboardingController extends Controller
{
    public function store(OnboardingRequest $request)
    {
        // On prépare les données
        $passableData = [
            'user'    => $request->user(),
            'request' => $request->validated(),
        ];

        try {
            // On lance le Pipeline
            Pipeline::send($passableData)
                ->through([
                    SaveProfileData::class,
                    MarkAccountAsOnboarded::class,
                ])
                ->thenReturn();

            return response()->json([
                'message'  => 'Onboarding terminé avec succès !',
                'redirect' => env('FRONTEND_URL') . '/dashboard'
            ], 200);

        } catch (\Exception $e) {
            FacadesLog::info($e);
            return response()->json([
                'message' => 'Une erreur est survenue pendant l\'onboarding.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}