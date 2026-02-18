<?php

namespace App\Contracts;

use App\Models\Login;
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


    /**
     * Vérifie si un compte Login existe.
     */
    public function findLogin(string $email): ?Login;

    /**
     * Récupère le token JWT existant depuis la session ou retourne null si inexistant.
     *
     * @return string|null
     */
    public function getExistingToken(): ?string;

    /**
     * Récupère l'AccountId de l'utilisateur connecté à partir du token actuel.
     * Retourne null si pas de token ou token invalide.
     * @return integer|null
     */
    public function getCurrentAccountId(): ?int;

    /**
     * Récupère le RoleId de l'utilisateur connecté à partir du token actuel.
     * Retourne null si pas de token ou token invalide.
     * @return integer|null
     */
    public function getCurrentRoleId(): ?int;

    /**
     * Récupère tous les login
     */
    public function GetAllAsync();
}
