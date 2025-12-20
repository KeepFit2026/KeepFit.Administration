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

    /**
     * Filtre les programmes pour récupérer que les exercises qui ne sont pas dans le programme.
    */
    public function filterAvailablePrograms(string $exerciseId) 
    {
        return $this->get("/$exerciseId/without-programs");
    }

    /**
     * Enregistre un exercise dans un programme
     *
     * @param string $programId GUID du programme.
     * @param string $exerciseId GUID de l'exercice.
     */
    public function addExerciseToProgram(string $programId, string $exerciseId)
    {   
        return $this->get("/$exerciseId/programs/$programId/");
    }
}