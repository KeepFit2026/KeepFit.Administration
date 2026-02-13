<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->name('login.')->group(function() {
    Route::get('/logout', 'logout')->name('logout');
    Route::get('first-connexion', 'firstLoginWebPortal')->name('first-connexion');
    Route::post('first-connexion', 'loginWebPortalWithNewAccount')->name('post.first-connexion');
    Route::get('', 'index')->name('index');
    Route::post('', 'loginWebPortal')->name('post.loginWebPortal');
});
