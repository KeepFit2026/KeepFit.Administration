<?php

namespace App\Http\Controllers;

use App\Constants\Enum\UserRole;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends AdminCrudController
{
    public function __construct(private UserService $service, AuthServiceInterface $authService)
    {
        parent::__construct($authService);
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

    protected function getDetailMethod(): ?string
    {
        return 'GetClassroomsFromUser';
    }

    public function store()
    {
        $request = $this->getRequestClass();
        $validated = app($request)->validated();

        $result = $this->getService()->registerAccount($validated['email'], $validated['role']);
        
        return isset($result['error'])
            ? back()->withInput()->with('error', 'Erreur lors de la création du login')
            : redirect()->back()->with('success', 'Création réussie.');
    }

    public function addUserToClassroom(string $id) 
    {
        return view('Admin.Users.addToClassroom', [
            'user' => $this->service->GetByIdAsync($id),
            'classrooms' => $this->service->filterAvailableClassroom($id)
        ]);
    }

    public function addUserToClassroomExecute(string $userId, Request $request)
    {
        $classroomId = $request->input('classroom_id');

        $result = $this->service->addUserToClassroom($classroomId, $userId);
        
        if($result) return redirect()->back()->with('success', 'Utilisateur ajouté à la classe avec succès !');
    }
}