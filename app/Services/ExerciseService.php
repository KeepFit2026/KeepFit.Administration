<?php

namespace App\Services;

class ExerciseService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "exercises";
    }

    public function GetProgramsFromExercise(string $exerciseId)
    {
        return $this->get("/$exerciseId/programs");
    }
}