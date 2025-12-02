<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AdminServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $Items;

    public function __construct(
        private AdminServiceInterface $adminService,
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
