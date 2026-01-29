<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckApi;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->name('login.')->group(function() {
    Route::post('/logout', 'logout')->name('logout');
    Route::get('first-connexion', 'firstLoginWebPortal')->name('first-connexion');
    Route::post('first-connexion', 'loginWebPortalWithNewAccount')->name('post.first-connexion');
    Route::get('', 'index')->name('index');
    Route::post('', 'loginWebPortal')->name('post.loginWebPortal');
});

Route::get('/admin/requestChangePassword', [AdminController::class, 'requestChangePasswordPage'])
    ->name('admin.requestChangePassword');

Route::post('/admin/requestChangePassword', [AdminController::class, 'postRequestChangePasswordPage'])
    ->name('post.admin.requestChangePassword');
    
Route::prefix('/admin')
    ->controller(AdminController::class)
    ->name('admin.')
    ->middleware(['checkRole:ADMIN', CheckApi::class])
    ->group(function() {

        Route::resource('', AdminController::class);
        Route::get('/chats', 'chat')->name('chat');
        
        Route::resource('programs', ProgramController::class);

        Route::get('create-account', 'createAccount')->name('create-account');

        Route::get('/error-api', function() {
            return response()->view('Error.API', [], 503);
        })->name('error.api');

        Route::resource('exercises', ExerciseController::class)
            ->middleware(CheckApi::class);

        Route::resource('users', UserController::class);
        Route::resource('classrooms', ClassroomController::class);

         Route::controller(UserController::class)
            ->prefix('users')
            ->name('users.')
            ->group(function() {
                Route::post('{id}/addclassroom-page', 'addUserToClassroomExecute')->name('post.addUserToClassroom');
                Route::get('{id}/addclassroom-page', 'addUserToClassroom')->name('addUserToClassroom');
        });

        Route::controller(ExerciseController::class)
            ->prefix('exercises')
            ->name('exercises.')
            ->group(function() {
                Route::get('/{id}/addprogram-page', 'addToProgramPage')->name('addToProgramPage');
                Route::post('/{id}/addprogram-page', 'addToProgramExecute')->name('post.addToProgramPage');
        });

        Route::controller(ChatController::class)
            ->prefix('/chat')
            ->name('chat.')
            ->group(function() {
                Route::post('/create', 'createChat')->name('create');
            });

    });
