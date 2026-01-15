<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CheckApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        //Si l'état de l'API est déjà enregistrer dans le cache.
        if(Cache::get('api_down'))
            return redirect()->route('admin.error.api');

        //Etat de l'API.
        $apiStatus = Cache::remember('api_status', 60, function() {
            try {
                $response = Http::get(config('services.keepfit.base_url') . '/health-check');
                return $response->successful();
            } catch(Exception $e) {
                return false;
            }
        });

        //Si l'api ne répond pas --> !false = true.
        if(!$apiStatus) {
            Cache::put('api_down', true, 60);
            return redirect()->route('admin.error.api');
        }

        return $next($request);
    }
}
