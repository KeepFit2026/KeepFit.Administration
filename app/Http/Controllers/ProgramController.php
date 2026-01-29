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

    protected function getViewFolder(): string
    {
        return 'Admin.Programs';
    }

    protected function getRequestClass()
    {
        return ExerciseRequest::class;
    }

    protected function getDataKey(): string
    {
        return "programs";
    }

    protected function getDetailMethod(): ?string
    {
        return 'GetExercisesFromProgram';
    }

    protected function getStats($data, $totalRecords): array
    {
        $stats = parent::getStats($data, $totalRecords);

        $stats[] = [
            'name' => 'Programmes terminés',
            'subname' => 'Terminés',
            'totalRecords' => 0,
            'class' => 'success'
        ];

        return $stats;
    }
}