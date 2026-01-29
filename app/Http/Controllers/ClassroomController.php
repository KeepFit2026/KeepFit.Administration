<?php

namespace App\Http\Controllers;

use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ClassroomRequest;
use App\Services\ClassroomService;

class ClassroomController extends AdminCrudController
{
    public function __construct(
        private ClassroomService $service,
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
        return 'Admin.Classrooms';
    }

    protected function getRequestClass()
    {
        return ClassroomRequest::class;
    }

    protected function getDataKey(): string
    {
        return "classrooms";
    }

    protected function getDetailMethod(): ?string
    {
        return 'GetUsersFromClassroom';
    }
}