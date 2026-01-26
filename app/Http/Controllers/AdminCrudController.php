<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Contracts\AuthServiceInterface;

abstract class AdminCrudController extends Controller
{
    protected $items;

    abstract protected function getService();      
    abstract protected function getViewFolder(): string;  
    abstract protected function getRequestClass();
    abstract protected function getDataKey(): string;     

    public function __construct(private AuthServiceInterface $authService)
    {
        $this->items = AdminMenu::all();
    }

    protected function getToken(): ?string
    {
        return $this->authService->getExistingToken();
    }

    protected function getUserRoleId(): ?int
    {
        return $this->authService->getCurrentRoleId();
    }

    protected function render(string $view, array $data = [])
    {
        return view($view, array_merge([
            'items' => $this->items
        ], $data));
    }

    public function index()
    {
        $response = $this->getService()->GetAllAsync();

        $stats = $this->getStats($response, $response['totalRecords'] ?? 0);

        return $this->render("{$this->getViewFolder()}.index", [
            $this->getDataKey()     => $response['data'] ?? [],
            'errorMessage'          => $response['error'] ?? null,
            'stats'                 => $stats
        ]);
    }

    public function create()
    {
        return $this->render("{$this->getViewFolder()}.create");
    }

    public function store()
    {
        $requestClass = $this->getRequestClass();
        $validated = app($requestClass)->validated();

        $result = $this->getService()->CreateAsync($validated);

        return isset($result['error'])
            ? back()->withInput()->with('error', $result['error'])
            : redirect()->back()->with('success', 'Création réussie.');
    }

    public function show(string $id, $details = null)
    {
        $service = $this->getService();
        $response = $service->GetByIdAsync($id);

        $optionalMethods = [
            'GetProgramsFromExercise',
            'getExercisesFromProgram'
        ];

        foreach($optionalMethods as $method) {
            if(method_exists($service, $method)) {
                $details = $service->$method($id);
                break;
            }
        }

        return $this->render("{$this->getViewFolder()}.show", [
            $this->getDataKey()     => $response['data'] ?? null,
            'errorMessage'          => $response['error'] ?? null,
            'programsFromExercise'  => $details
        ]);
    }

    public function destroy(string $id)
    {
        $this->getService()->DeleteAsync($id);
        return redirect()->route("admin." . $this->getDataKey() . ".index");
    }

    protected function getStats($data, $totalRecords): array
    {
        return [
            [
                'name'         => 'Total des ' . $this->getDataKey(),
                'subname'      => ucfirst($this->getDataKey()) . ' créés',
                'totalRecords' => $totalRecords,
                'class'        => ''
            ]
        ];
    }
}