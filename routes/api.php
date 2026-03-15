<?php

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
