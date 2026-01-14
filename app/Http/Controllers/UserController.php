<?php

namespace App\Http\Controllers;

use App\Constants\Enum\UserRole;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends AdminCrudController
{

    public function __construct(private UserService $service, AuthServiceInterface $authService)
    {
        return parent::__construct($authService);
    }

    protected function getService() 
    {
        return $this->service;
    }    

    protected function getViewFolder(): string
    {
        return 'Admin.Users';
    }  

    protected function getRequestClass()
    {
        return UserRequest::class;
    }

    protected function getDataKey(): string
    {
        return 'users';
    }  

    /**
     * Surcharge de la méthode store du Controller Générique
     *
     * @return void
     */
    public function store()
    {
        $request = $this->getRequestClass();
        $validated = app($request)->validated();


        $result = $this->getService()->registerAccount($validated['email'], $validated['role']);
        
        return isset($result['error'])
            ? back()->withInput()->with('error', 'Erreur lors de la création du login')
            : redirect()->back()->with('success', 'Création réussie.');
    }
}
