<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserService $service ) {}

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

    /**
     * Récupère l'utilisateur connecté
     * @return void
     */
    public function user()
    {
        return $this->service->getCurrentUser();
    }

    /**
     * Ajoute de l'xp à l'utilisateur
     * @param Request $request récupère le nombre d'xp
     */
    public function addXp(Request $request)
    {
        $nbXp = $request->input('nbXp', 10);
        return $this->service->addXp($nbXp);
    }
}
