<?php

namespace App\Services;


class ClassroomService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "classrooms";
    }
}