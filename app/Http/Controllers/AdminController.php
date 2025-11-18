<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AdminServiceInterface;
use App\Contracts\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $Items;
    private $Token;

    public function __construct(
        private AdminServiceInterface $adminService,
        private AuthServiceInterface $authService,
        )
    {
        $this->Items = AdminMenu::all();
        $this->Token = session('auth');
    }

    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        $user = $this->authService->getTokenPayload($this->Token)['AccountId'];

        return view('Admin.index', [
            'user' => User::findNameByAccountId($user),
            'items' => $this->Items,
        ]);
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
