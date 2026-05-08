<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Route Lié à la documentation swagger. Ne pas toucher
*/
Route::get('docs/{jsonFile?}', function ($jsonFile = null) {
    $jsonFile = $jsonFile ?: 'api-docs.json';
    $filePath = storage_path('api-docs/' . $jsonFile);

    if (!file_exists($filePath)) {
        abort(404, 'Documentation file not found');
    }

    return response()->file($filePath);
})->name('l5-swagger.default.docs');

Route::get('/admin/pdf/{id}', [UserController::class, 'generateUserPdf']);

/**
 * Authentification
 */
Route::controller(AuthController::class)->middleware(['web'])->group(function() {
    Route::post('/login', 'login')->name('post.login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth:sanctum', 'web'])->group(function() {

    //Onboarding
    Route::post('/onboarding', [OnboardingController::class, 'store']);

    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'user');
        Route::post('/addXp', 'addXp');
    });
});

Route::controller(QuizzController::class)->prefix('/quizz')->group(function() {
    Route::get('/today', 'showToday');
    Route::get('', 'getQuizzByDate');
    Route::get('/{uuid}', 'show');
    Route::post('/{uuid}/submit', 'submitQuizz');
});
