<?php

namespace App\Services;

use App\Models\Login;
use Illuminate\Support\Facades\Log;
use Str;

class UserService extends AbstractApiService 
{
    public function endpoint(): string 
    {
        return "users";
    }

    /**
     * Enregistre un login en base de donnée
     *
     * @param string $email email de l'utilisateur
     * @param integer $roleId roleId de l'utilisateur
     * @return void
     * 
     * note : récup le mot de passe généré par email.
     */
    public function registerAccount(string $email, int $roleId)
    {
        $password = Str::random(10);
        
        //Temporaire pour voir le mot de passe généré
        Log::info($password);

        Login::create([
            'email'    => $email,
            'roleId'   => $roleId,
            'password' => bcrypt($password),
        ]);
    }

    public function GetAvailableUsers()
    {
        return $this->get('/GetAvailableUsers');
    }

    public function getMyPrivateConv()
    {
        return $this->get('/myconv');
    }
}