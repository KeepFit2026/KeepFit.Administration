<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\ExerciseRequest;
use App\Models\User;
use App\Response\ApiResponse;
use App\Services\ProgramService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public $Items;
    private $Token;
    use ApiResponse;

    public function __construct(
        private ProgramService $service,
        private AuthServiceInterface $authService
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
        $programs = isset($response['error']) ? [] : ($response['data'] ?? []);
        $errorMessage = $response['error'] ?? null;
        $user = $this->authService->getTokenPayload($this->Token)['AccountId'];

        return view('Admin.Programs.index', [
            'items' => $this->Items,
            'programs' => $programs,
            'errorMessage' => $errorMessage,
            'user' => User::findNameByAccountId($user)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Programs.create', [
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
                ->with('error', $result['error'] ?? 'Erreur lors de la création du programmes.')
            : redirect()
                ->route('admin.programs.create')
                ->with('success', 'Programmes créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
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
        return redirect()->route('admin.programs.index');
    }
}
 