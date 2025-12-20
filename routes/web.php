<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->name('login.')->group(function() {

    Route::post('/logout', 'logout')->name('logout');

    Route::prefix('/login')->group(function() {
        Route::get('first-connexion', 'firstLoginWebPortal')->name('first-connexion');
        Route::post('first-connexion', 'loginWebPortalWithNewAccount')->name('post.first-connexion');

        Route::get('', 'index')->name('index');
        Route::post('', 'loginWebPortal')->name('post.loginWebPortal');
    });
});

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
        Route::resource('/programs', ProgramController::class);
        Route::get('create-account', 'createAccount')->name('create-account');

        Route::prefix('/exercises')
            ->controller(ExerciseController::class)
            ->name('exercises.')
            ->group(function() {
                Route::post('{id}/addprogram-page', 'addToProgramExecute')->name('post.addToProgramPage');
                Route::get('/{id}/addprogram-page', 'addToProgramPage')->name('addToProgramPage');
        });

        Route::resource('exercises', ExerciseController::class);
        
    });