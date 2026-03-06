<?php

namespace App\Contracts;

use App\Models\Login;

interface AuthServiceInterface
{
    /**
     * Renvoie l'utilisateur en fonction de ses identifiants.
     * @param array $data
     * @return Login|null
     */
    public function getLogin(array $data): Login|null;

    /**
     * Enregistre un compte liée au compte de connexion de la table login.
     * @param array $data
     * @return boolean
     */
    public function register(array $data, string $uuid);
}
