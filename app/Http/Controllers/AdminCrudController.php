<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\AuthServiceInterface;

abstract class AdminCrudController extends Controller
{
    protected $items;
    protected $token;
    protected $userAccountId;

    abstract protected function getService();      
    abstract protected function getViewFolder();  
    abstract protected function getRequestClass();
    abstract protected function getDataKey();     

    public function __construct(private AuthServiceInterface $authService)
    {
        $this->items = AdminMenu::all();
        $this->token = session('auth');

        $payload = $this->authService->getTokenPayload($this->token) ?? [];
        $this->userAccountId = $payload['AccountId'] ?? null;
    }

    protected function adminUser()
    {
        if (!$this->userAccountId) {
            return null;
        }
        return User::findNameByAccountId($this->userAccountId);
    }

    protected function render(string $view, array $data = [])
    {
        return view($view, array_merge([
            'items' => $this->items,
            'user'  => $this->adminUser()
        ], $data));
    }

    public function index()
    {
        $response = $this->getService()->GetAllAsync();

        return $this->render("{$this->getViewFolder()}.index", [
            $this->getDataKey() => $response['data'] ?? [],
            'errorMessage'      => $response['error'] ?? null
        ]);
    }

    public function create()
    {
        return $this->render("{$this->getViewFolder()}.create");
    }

    public function store(Request $request)
    {
        $requestClass = $this->getRequestClass();
        $validated = app($requestClass)->validated();

        $result = $this->getService()->CreateAsync($validated);

        return isset($result['error'])
            ? back()->withInput()->with('error', $result['error'])
            : redirect()->back()->with('success', 'Création réussie.');
    }

    public function show(string $id)
    {
        $response = $this->getService()->GetByIdAsync($id);

        return $this->render("{$this->getViewFolder()}.show", [
            $this->getDataKey()     => $response['data'] ?? null,
            'errorMessage'          => $response['error'] ?? null,

        ]);
    }

    public function destroy(string $id)
    {
        $this->getService()->DeleteAsync($id);
        return redirect()->route("admin." . $this->getDataKey() . ".index");
    }
}