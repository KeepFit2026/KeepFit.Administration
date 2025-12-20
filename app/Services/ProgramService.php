<?php

namespace App\Services;


class ProgramService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "programs";
    }

    public function getExercisesFromProgram(string $programId)
    {
        return $this->get("/$programId/exercises");
    }
}

