<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

/**
 * Class générique pour les méthodes CRUD.
 */
abstract class AbstractApiService implements ApiServiceInterface
{
    protected $baseUrl;

    abstract protected function endpoint(): string;

    /**
     * Create a new class instance.
    */
    public function __construct()
    {
        $this->baseUrl = config('services.keepfit.base_url');
    }

    public function GetAllAsync(): JsonResponse|array 
    {
        return $this->get('');
    }

    public function GetByIdAsync(string $id): JsonResponse|array
    {
        return $this->get("/$id");
    }

    public function CreateAsync(array $data): JsonResponse|array 
    {
        return $this->post('', $data);
    }

    public function DeleteAsync(string $id): JsonResponse|array 
    {
        return $this->delete("/$id");
    }
    
    /**
     * Méthode interne pour faire le GET et gérer exceptions
    */
    protected function get(string $path): JsonResponse|array 
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = Http::timeout(5)->get($url);

            return $response->successful() ? $response->json() : [];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }

    /**
     * Méthode interne pour faire le POST et gérer exceptions
    */
    protected function post(string $path, array $data): JsonResponse|array
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = Http::timeout(5)->post($url, $data);

            return $response->successful() ? $response->json() : [
                'error' => 'Erreur lors de la création de la ressource.'
            ];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }

    /**
     * Méthode interne pour faire le DELETE et gérer les exceptions
    */
    protected function delete(string $path): JsonResponse|array
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = Http::timeout(5)->delete($url);

            if ($response->successful()) {
                return $response->json() ?? ['message' => 'Ressource supprimée avec succès.'];
            }

            return ['error' => 'Erreur lors de la suppression de la ressource.'];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }
}