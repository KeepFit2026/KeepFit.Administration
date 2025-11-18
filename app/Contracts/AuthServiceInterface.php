<?php

namespace App\Contracts;

use App\Models\User;

interface AuthServiceInterface
{

    /**
     * Gère l'authentification de l'utilisateur et génère un token JWT si la connexion est réussie.
     *
     * @param string $email
     * @param string $password
     * @return array
    */
    public function authentification(string $email, string $password): array;


    /**
     * Permet la déconnexion utilisateur.
    */
    public function logout(string $token): bool;

    /**
     * Enregistre un nouveau compte utilisateur à la première connexion.
     *
     * @return void
    */
    public function registerUserAccount(array $data): void;

    /**
     * Récupère le payload du token en session.
     *
     * @param string $token
     * @return array
     */
    public function getTokenPayload(string $token): array;
}
