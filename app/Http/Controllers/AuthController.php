<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoginRequest;
use App\Http\Requests\FirstLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Response\ApiResponse;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;

class AuthController extends Controller
{  
    use ApiResponse;

    public function __construct(private AuthService $service){}

    public function index() 
    {
        return view('Auth.login');
    }

    /**
     * Permet de se connecter au dashboard administrateur
     *
     * @param LoginRequest $request
     * @return void
     */
    public function loginWebPortal(LoginRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->service->authentification(
            $credentials['email'],
            $credentials['password']
        );

        if ($result['token']) {

            $user = Login::where('email', $credentials['email'])->first();
            
            Auth::guard('web')->login($user);

            session(['auth' => $result['token']]);

            if (!empty($result['new']) && $result['new'] === true) {
                return redirect()->route('login.first-connexion');
            }

            return redirect()->intended('admin');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    /**
     * A la premiere connexion de l'utilisateur sur l'application.
     *
     * @return void
    */
    public function firstLoginWebPortal() 
    {
        return view('Auth.First');
    }

    /**
     * Enregistre le nouveau compte et redirige vers la page de connexion.
     */ 
    public function loginWebPortalWithNewAccount(FirstLoginRequest $request)
    {
        $data = $request->validated();

        try {
            $this->service->registerUserAccount($data);

            return redirect()->route('login.index');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Déconnexion de l'utilisateur.
     *
     * @return void
     */
    public function logout() 
    {
        $token = session('auth');
        
        Auth::guard('web')->logout();
        session()->forget('auth');
        session()->invalidate();
        session()->regenerateToken();

        if($token) $this->service->logout($token);
        
        return redirect()->route('login.index')->with('success', 'Déconnexion réussie');
    }
}