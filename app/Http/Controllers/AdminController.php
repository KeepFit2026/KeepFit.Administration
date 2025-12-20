<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AdminServiceInterface;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\EmailRequest;
use App\Models\RequestResetPassword;
use Illuminate\Http\Request;
use Str;

class AdminController extends Controller
{
    public $Items;

    public function __construct(
        private AdminServiceInterface $adminService,
        private AuthServiceInterface $authService
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
     * Temporaire
     *
     * @return void
     */
    public function CreateAccount() 
    {
        return $this->adminService->CreateAccount();
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
