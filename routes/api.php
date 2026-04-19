<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Models\Login;
use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum', 'web'])->get('/user', function (Request $request) {
    return response()->json(new UserResource($request->user()));
});

Route::get('/profile-tempo', function() {
    $login = Login::with('user', 'roles')->skip(1)->first();

    return response()->json([
        'login' => $login,
        'roles' => $login->roles->pluck('name'),
        'user' => $login->user,
    ]);
});