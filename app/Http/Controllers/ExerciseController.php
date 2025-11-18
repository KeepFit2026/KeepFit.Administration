<?php

namespace App\Http\Controllers;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Services\ExerciseService;

class ExerciseController extends AdminCrudController
{

    public function __construct(
        private ExerciseService $service,
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
}
