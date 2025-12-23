<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;
use App\Http\Middleware\CheckApi;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->name('login.')->group(function() {
    Route::post('/logout', 'logout')->name('logout');
    Route::get('first-connexion', 'firstLoginWebPortal')->name('first-connexion');
    Route::post('first-connexion', 'loginWebPortalWithNewAccount')->name('post.first-connexion');
    Route::get('', 'index')->name('index');
    Route::post('', 'loginWebPortal')->name('post.loginWebPortal');
});

/**
 * Cas Partiel
*/
Route::get('/admin/requestChangePassword', [AdminController::class, 'requestChangePasswordPage'])
    ->name('admin.requestChangePassword');

Route::post('/admin/requestChangePassword', [AdminController::class, 'postRequestChangePasswordPage'])
    ->name('post.admin.requestChangePassword');

    
Route::prefix('/admin')
    ->controller(AdminController::class)
    ->name('admin.')
    ->middleware('checkRole:ADMIN')
    ->group(function() {

        Route::resource('', AdminController::class);
        Route::resource('/programs', ProgramController::class)->middleware(CheckApi::class);

        //Temporaire.
        Route::get('create-account', 'createAccount')->name('create-account');

        // Si erreur en lien avec l'API
        Route::get('/error-api', function() {
            return response()->view('Error.API', [], 503);
        })->name('error.api');

        Route::prefix('/exercises')
            ->middleware(CheckApi::class)
            ->controller(ExerciseController::class)
            ->name('exercises.')
            ->group(function() {
                Route::resource('', ExerciseController::class);
                Route::get('/{id}/addprogram-page', 'addToProgramPage')->name('addToProgramPage');
                Route::post('/{id}/addprogram-page', 'addToProgramExecute')->name('post.addToProgramPage');
        });
        
    });