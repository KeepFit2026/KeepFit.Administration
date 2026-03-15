<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Genère un PDF sur un utilisateur (avec la table 'Profile' et 'Login')
     * @param string $uuid Id de l'utilisateur
     * @return void
     */
    public function generateUserPdf(string $uuid)
    {
        $login = Login::find($uuid);
        $user = User::where('account_id', $uuid)->first();
        $pdf  = Pdf::loadView('filament.pages.user-pdf', [
            'record' => $login,
            'user'   => $user,
            ]);
        return $pdf->download(($user->name ?? 'utilisateur') . '-fiche.pdf');
    }
}
