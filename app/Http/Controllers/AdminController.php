<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AdminServiceInterface;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\EmailRequest;
use App\Models\RequestResetPassword;
use App\Services\UserService;
use Illuminate\Http\Request;
use Str;

class AdminController extends Controller
{
    public $Items;

    public function __construct(
        private AuthServiceInterface $authService,
        private UserService $userService
        )
    {
        $this->Items = AdminMenu::all();
    }

    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return view('Admin.index', [
            'items' => $this->Items,
        ]);
    }

    public function chat()
    {
        $token = $this->authService->getExistingToken();
        $users = $this->userService->GetAvailableUsers($this->authService->getTokenPayload($token)['AccountId']);
        $myconv = $this->userService->getMyPrivateConv();
        
        return view('Admin.chat', [
            'users' => $users,
            'conv' => $myconv
        ]);
    }

    public function requestChangePasswordPage() 
    {
        return view('Auth.changePasswordPage');
    }

    public function postRequestChangePasswordPage(EmailRequest $request)
    {
        $validatedEmail = $request->validated();
        $ifAccountExist = $this->authService->findLogin($validatedEmail['email']);

        //Si le compte existe.
        if($ifAccountExist->exists) {

            // Génére une chaine aléatoire
            $chaine = Str::random(64);
            //Construit l'URL pour reset
            $resetUrl = url("/reset-password/{$chaine}?email=" . urlencode($validatedEmail['email']));

            RequestResetPassword::create([
                'accountId' => $ifAccountExist->id,
                'link' => $resetUrl
            ]);
        }
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
