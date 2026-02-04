<?php

namespace App\Services;


class ClassroomService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "classrooms";
    }

    public function GetUsersFromClassroom(string $userId)
    {
        return $this->get("/$userId/exercises");
    }
}