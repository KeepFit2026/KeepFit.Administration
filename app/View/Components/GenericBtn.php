<?php

namespace App\View\Components;

use App\Constants\Enum\ButtonVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class GenericBtn extends Component
{
    public ?string $url;
    public string $name;
    public ButtonVariant $variant;
    public string $method;

    public function __construct(
        string $name,
        string|object|null $route = null,
        ?string $variant = null,
        string $method = "GET"
    ) {
        $this->name = $name;
        $this->variant = ButtonVariant::tryFrom($variant) ?? ButtonVariant::CREATE;
        $this->method = strtoupper($method);

        if ($route instanceof RedirectResponse) {
            $this->url = $route->getTargetUrl();
        } elseif (is_string($route) && Route::has($route)) {
            $this->url = route($route);
        } else {
            $this->url = (string) $route;
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.generic-btn');
    }
}