<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Réponse succès simple sans données
     */
    public function success(string $message = 'Opération réussie', int $status = 200): JsonResponse
    {
        return $this->JsonConvert(true, null, $message, $status);
    }

    /**
     * Réponse succès avec données
     */
    public function successWithData($data, string $message = 'Opération réussie', int $status = 200): JsonResponse
    {
        return $this->JsonConvert(true, $data, $message, $status);
    }

    /**
     * Réponse erreur simple
     */
    public function error(string $message = 'Une erreur est survenue', int $status = 400): JsonResponse
    {
        return $this->JsonConvert(true, null, $message, $status);
    }

    /**
     * Réponse 404 Not Found
     */
    public function notFound(string $message = 'Ressource non trouvée'): JsonResponse
    {
        return $this->JsonConvert(true, null, $message, 404);
    }

    /**
     * Réponse 422 Validation Error
     */
    public function validationError($errors, string $message = 'Validation échouée'): JsonResponse
    {
        return $this->JsonConvert(true, $errors, $message, 422);
    }

    /**
     * Réponse 500 Internal Error
     */
    public function serverError(string $message = 'Erreur serveur'): JsonResponse
    {
        return $this->JsonConvert(true, null, $message, 500);
    }

    /**
     * Méthode centrale pour générer la réponse JSON
     */
    protected function JsonConvert(bool $success, $data = null, ?string $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'data'    => $data,
            'message' => $message,
        ], $status);
    }
}