<?php

namespace App\Http\Controllers;

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
}
