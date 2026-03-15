<?php

use Illuminate\Support\Facades\Route;

// Redirection de la racine vers /admin (ou alors /admin/login)
Route::redirect('/', '/admin');