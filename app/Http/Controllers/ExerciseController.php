<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Models\User;
use App\Response\ApiResponse;
use App\Services\ExerciseService;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public $Items;
    private $Token;
    use ApiResponse;

    public function __construct(
        private ExerciseService $service,
        private AuthServiceInterface $authService,
        )
    {
        $this->Items = AdminMenu::all();
        $this->Token = session('auth');
    }

    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        $response = $this->service->GetAllAsync();
        $exercises = isset($response['error']) ? [] : ($response['data'] ?? []);
        $errorMessage = $response['error'] ?? null;

        $user = $this->authService->getTokenPayload($this->Token)['AccountId'];

        return view('Admin.Exercises.index', [
            'items' => $this->Items,
            'exercises' => $exercises,
            'errorMessage' => $errorMessage,
            'user' => User::findNameByAccountId($user)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Exercises.create', [
            'items' => $this->Items
        ]);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(ExerciseRequest $request)
    {
        $credential = $request->validated();
        $result = $this->service->CreateAsync($credential);

        return isset($result['error'])
            ? redirect()->back()
                ->withInput()
                ->with('error', $result['error'] ?? 'Erreur lors de la création de l’exercice.')
            : redirect()
                ->route('admin.exercises.create')
                ->with('success', 'Exercice créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->service->GetByIdAsync($id);
        $exercise = isset($response['error']) ? [] : ($response['data'] ?? []);

        return view('Admin.Exercises.show', [
            'items' => $this->Items,
            'exercise' => $exercise,
            'errorMessage' => $response['error'] ?? null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->DeleteAsync($id);
        return redirect()->route('admin.exercises.index');
    }
}
 