<?php

namespace App\Services;

class ExerciseService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "exercises";
    }
}