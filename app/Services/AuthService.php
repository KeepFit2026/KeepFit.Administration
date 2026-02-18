<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;
use App\Models\Login;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

use function PHPSTORM_META\type;

class AuthService implements AuthServiceInterface
{
    /**
     * Authentifie un utilisateur (PGSQL) et vérifie son existence dans SQL Server.
     */
    public function authentification(string $email, string $password): array
    {
        $login = $this->findLogin($email);
        if (!$login) {
            return $this->authFailureResponse('Utilisateur introuvable.');
        }

        $token = $this->generateJwtToken($login, $password);
        if (!$token) {
            return $this->authFailureResponse('Identifiants incorrects.');
        }

        $claims = $this->getTokenPayload($token);

        return $this->handleAccountExistence($token, $claims);
    }

    public function GetAllAsync()
    {
        return Login::paginate(10);
    }

    /**
     * Crée un nouveau compte utilisateur dans la base SQL Server et modifie le mot de passe dans le login PgSQL.
     */
    public function registerUserAccount(array $data): void
    {
        try {
            $token = $this->getExistingToken();

            if (!$token) {
                throw new \Exception("Token introuvable ou expiré.");
            }

            $accountId = $this->getTokenPayload($token)['AccountId'];

            // Hash du mot de passe avant insertion
            $passwordHash = bcrypt($data['password']);

            // Création de l'utilisateur dans la base SQL Server
            Log::info('Début de la création du User...');

            $user = User::create([
                'Name' => $data['name'],
                'AccountId' => $accountId,
                'RoleId' => Login::FindRoleByAccountId($accountId)
            ]);

            Log::info('Succès ! User créé avec ID : ' . $user->getKey());

            // Mise à jour du mot de passe dans le login PostgreSQL
            $login = Login::find($accountId);
            if (!$login) {
                throw new \Exception("Login introuvable pour l'AccountId: $accountId");
            }

            $login->password = $passwordHash;
            $login->save();

        } catch (\Exception $e) {
            Log::error("Erreur Register : " . $e->getMessage());
            throw new \Exception("Impossible de créer le compte : " . $e->getMessage());
        }
    }

    /**
     * Déconnecte un utilisateur en invalidant le token JWT.
     */
    public function logout(string $token): bool
    {
        try {
            JWTAuth::setToken($token)->invalidate();
            return true;
        } catch (TokenExpiredException $e) {
            // Si le token est déjà expiré, considérer comme déconnecté
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }

    /**
     * Récupère le payload du token JWT.
     */
    public function getTokenPayload(string $token): array
    {
        try {
            $payload = JWTAuth::setToken($token)->getPayload()->toArray();

            if (!isset($payload['roleId'])) {
                throw new \Exception('Token invalide ou incomplet.');
            }

            return $payload;

        } catch (TokenExpiredException $e) {
            throw new \Exception('Le token a expiré.');
        } catch (JWTException $e) {
            throw new \Exception('Token invalide.');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Récupère l'AccountId de l'utilisateur connecté à partir du token actuel.
     * Retourne null si pas de token ou token invalide.
     */
    public function getCurrentAccountId(): ?int
    {
        $token = $this->getExistingToken();

        if (!$token) {
            return null;
        }

        try {
            $payload = $this->getTokenPayload($token);
            return $payload['AccountId'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Récupère le token JWT existant depuis la session ou retourne null si inexistant.
     */
    public function getExistingToken(): ?string
    {
        try {
            $token = session('auth');

            if ($token && JWTAuth::setToken($token)->check()) {
                return $token;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

   /**
     * Récupère le RoleId de l'utilisateur connecté à partir du token actuel.
     * Retourne null si pas de token ou token invalide.
     * @return integer|null
    */
    public function getCurrentRoleId(): ?int
    {
        $token = $this->getExistingToken();

        if (!$token) {
            return null;
        }

        try {
            $payload = $this->getTokenPayload($token);
            return $payload['roleId'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Vérifie si le login existe dans la base PGSQL.
     */
    public function findLogin(string $email): ?Login
    {
        return Login::where('email', $email)->first();
    }


    /**
     * Génère un JWT avec claims personnalisés.
     */
    private function generateJwtToken(Login $login, string $password): ?string
    {
        $credentials = [
            'email' => $login->email,
            'password' => $password,
        ];

        $claims = [
            'AccountId' => $login->id,
            'email'     => $login->email,
            'roleId'    => $login->roleId,
        ];

        return JWTAuth::claims($claims)->attempt($credentials);
    }

    /**
     * Gère l'existence du compte SQL Server.
     */
    private function handleAccountExistence(string $token, array $claims): array
    {
        $accountExists = User::existingAccount($claims['AccountId']);

        return $accountExists
            ? $this->authSuccessResponse($token)
            : $this->authSuccessNewAccount($token);
    }

    /**
     * Réponse standard en cas de succès.
     */
    private function authSuccessResponse(string $token): array
    {
        return [
            'success' => true,
            'token' => $token,
        ];
    }

    /**
     * Réponse standard en cas d’échec.
     */
    private function authFailureResponse(string $message): array
    {
        return [
            'success' => true,
            'token' => null,
            'message' => $message,
        ];
    }

    /**
     * Réponse en cas de succès avec nouveau compte.
     */
    private function authSuccessNewAccount(string $token): array
    {
        return [
            'success' => true,
            'token' => $token,
            'new' => true,
        ];
    }
}