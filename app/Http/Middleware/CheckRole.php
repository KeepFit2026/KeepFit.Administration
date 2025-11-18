<?php

namespace App\Http\Middleware;

use App\Constants\Enum\UserRole;
use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $service = new AuthService();
        $token = session('auth');

        if (!$token) {
            return redirect()->route('login.index');
        }

        try {
            $payload = $service->getTokenPayload($token);
            if (!$payload) throw new \Exception('Token invalide');

            $userRole = $payload['roleId'];
            $allowedRoles = array_map(fn($role) => UserRole::fromMixed($role)->value, $roles);

            if (!in_array($userRole, $allowedRoles)) {
                abort(403, 'Accès refusé : rôle non autorisé');
            }

        } 
        
        // Ne pas intercepter les abort(403)
        catch (HttpException $e) {
            throw $e;
        }
        
        catch (\Exception $e) {
            session()->forget('auth');
            return redirect()->route('login.index')
                ->withErrors(['token' => 'Session expirée ou invalide.']);
        }

        return $next($request);
    }
}
