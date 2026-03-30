<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            $redirect = $user->roles->contains('name', 'admin') ? env('APP_URL') . '/admin' : env('FRONTEND_URL') . '/dashboard';

            return response()->json([
                'message'   => 'Login réussi',
                'user'      => new UserResource($user),
                'redirect'  => $redirect
            ], 200);
        }

        return response()->json(['message' => 'Indentifiant incorrecte'], 401);
    }
}
