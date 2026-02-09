<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use App\Contracts\AuthServiceInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Log;

abstract class AbstractApiService implements ApiServiceInterface
{
    protected $baseUrl;
    protected $token;

    abstract protected function endpoint(): string;

    public function __construct(private AuthServiceInterface $authService)
    {
        $this->baseUrl = config('services.keepfit.base_url');
        $this->token = $this->authService->getExistingToken();
    }

    protected function getClient(): PendingRequest
    {
        $request = Http::timeout(5);

        if ($this->token) 
            $request->withToken($this->token);

        return $request;
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

    public function DeleteAsync(string $id): JsonResponse|array|bool 
    {
        return $this->delete("/$id");
    }
    
    protected function get(string $path): JsonResponse|array 
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = $this->getClient()->get($url);

            if ($response->status() === 401) {
                return ['error' => 'Session expirée, veuillez vous reconnecter.'];
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }

    protected function post(string $path, array $data): JsonResponse|array
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = $this->getClient()->post($url, $data);

            if ($response->status() === 401) {
                return ['error' => 'Session expirée.'];
            }

            return $response->successful() ? $response->json() : [
                'error' => $response->json()['message'] ?? 'Erreur lors de la création de la ressource.'
            ];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }

    protected function delete(string $path): JsonResponse|array|bool
    {
        try {
            $url = rtrim($this->baseUrl . '/' . $this->endpoint() . $path, '/');
            $response = $this->getClient()->delete($url);

            if ($response->status() === 401) {
                return ['error' => 'Session expirée.'];
            }

            if ($response->successful()) {
                return $response->json() ?? ['message' => 'Ressource supprimée avec succès.'];
            }

            return ['error' => 'Erreur lors de la suppression de la ressource.'];
        } catch (ConnectionException $e) {
            return ['error' => 'Impossible de contacter l’API.'];
        }
    }
}