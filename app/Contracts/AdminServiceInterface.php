<?php 

namespace App\Contracts;

interface AdminServiceInterface {

    /**
     * Permet à l'administrateur de créer un compte pour s'authentifier
     * 
     * @return void
     */
    public function CreateAccount(): void;
}