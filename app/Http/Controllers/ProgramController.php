<?php

namespace App\Http\Controllers;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Services\ProgramService;

class ProgramController extends AdminCrudController
{

    public function __construct(
        private ProgramService $service,
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
        return 'Admin.Programs';
    }

    protected function getRequestClass()
    {
        return ExerciseRequest::class;
    }

    protected function getDataKey()
    {
        return "programs";
    }
}
