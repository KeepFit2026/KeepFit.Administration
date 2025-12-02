<?php

namespace App\Http\Controllers;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Services\ExerciseService;
use App\Services\ProgramService;

class ExerciseController extends AdminCrudController
{

    public function __construct(
        private ExerciseService $service,
        private ProgramService $programService,
        private AuthServiceInterface $authService,
        ) {
            parent::__construct($authService);
        }

    protected function getService()
    {
        return $this->service;
    }

    protected function getViewFolder()
    {
        return 'Admin.Exercises';
    }

    protected function getRequestClass()
    {
        return ExerciseRequest::class;
    }

    protected function getDataKey()
    {
        return "exercises";
    }

    public function addToProgramPage(string $id) 
    {
        return view('Admin.Exercises.addToProgram', [
            'exercise' => $this->service->GetByIdAsync($id),
            'programs' => $this->programService->GetAllAsync()
        ]);
    }
}
