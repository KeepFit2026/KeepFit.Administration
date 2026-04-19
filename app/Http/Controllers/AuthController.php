<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if($user->roles->contains('name', 'admin')) {
                $redirect = env('APP_URL') . '/admin';

            } else {
                $redirect = $user->onboarding_completed || $user->roles->contains('name', 'teacher')
                    ? env('FRONTEND_URL') . '/dashboard'
                    : env('FRONTEND_URL') . '/onboarding'; //si l'utilisateur à le role 'user'
            }


            return response()->json([
                'message'   => 'Login réussi',
                'user'      => new UserResource($user),
                'redirect'  => $redirect
            ], 200);
        }

        return response()->json(['message' => 'Indentifiant incorrecte'], 401);
    }

    /**
     * Méthode de déconnexion, on invalide les sessions
    */
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()
        ->json(['message' => 'Déconnecté avec succès'], 200)
        ->withoutCookie('keepfit-session')
        ->withoutCookie('XSRF-TOKEN')
        ->withCookie(
            cookie(
                name: 'keepfit-session',
                value: '',
                minutes: -1,
                path: '/',
                domain: '',
                secure: false,
                httpOnly: true,
                sameSite: 'Lax',
            )
        )
        ->withCookie(cookie(
            name: 'XSRF-TOKEN',
            value: '',
            minutes: -1,
            path: '/',
            domain: '',
            secure: false,
            httpOnly: true,
            sameSite: 'Lax',
        ));
    }
}
