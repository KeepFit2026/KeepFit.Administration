<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;

interface ApiServiceInterface 
{
    /**
     * Récupère tous les élements.
     *
     * @return JsonResponse|array
     */
    public function GetAllAsync(): JsonResponse|array;

    /**
     * Récupère un élement en fonction de son Identifiant.
     *
     * @param string $id
     * @return JsonResponse|array
    */
    public function GetByIdAsync(string $id): JsonResponse|array;

    /**
     * Permet la création d'une Entité
     *
     * @param array $data Une Entité
     * @return JsonResponse|array
     */
    public function CreateAsync(array $data): JsonResponse|array;

    /**
     * Permet de supprimer une Entité
     *
     * @param string $id Id de l'entité.
     * @return JsonResponse|array
     */
    public function DeleteAsync(string $id): JsonResponse|array|bool;
}