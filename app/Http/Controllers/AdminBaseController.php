<?php

namespace App\Http\Controllers;

use App\Constants\AdminMenu;
use App\Models\User;
use App\Services\AuthService;

class AdminBaseController extends Controller
{
    protected $Items;
    protected $Token;
    protected $UserAccountId;

    public function __construct(private AuthService $authService)
    {
        $this->Items = AdminMenu::all();
        $this->Token = session('auth');
        $payload = $this->authService->getTokenPayload($this->Token);
        $this->UserAccountId = $payload['AccoundId'] ?? null;
    }

    protected function adminUser() 
    {
        return User::findNameByAccountId($this->UserAccountId);
    }

    protected function render(string $view, array $data = [])
    {
        return view($view, array_merge([
            'items' => $this->Items,
            'user' => $this->adminUser(),
        ]), $data);
    }
}
