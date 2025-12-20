<?php

namespace App\Http\Controllers;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Services\ExerciseService;
use Illuminate\Http\Request; 

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

    protected function getViewFolder(): string
    {
        return 'Admin.Exercises';
    }

    protected function getRequestClass()
    {
        return ExerciseRequest::class;
    }

    protected function getDataKey(): string
    {
        return "exercises";
    }

    public function addToProgramPage(string $id) 
    {
 
        return view('Admin.Exercises.addToProgram', [
            'exercise' => $this->service->GetByIdAsync($id),
            'programs' => $this->service->filterAvailablePrograms($id)
        ]);
    }

    public function addToProgramExecute(string $exerciseId, Request $request)
    {
        $programId = $request->input('program_id');

        //Ajoute le l'exercice dans le program.
        $result = $this->service->addExerciseToProgram($programId, $exerciseId);
        if($result) return redirect()->back()->with('success', 'Exercice ajouté au programme avec succès !');
    }
}
