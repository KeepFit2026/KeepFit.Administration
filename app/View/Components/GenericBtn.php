<?php

namespace App\View\Components;

use App\Constants\Enum\ButtonVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\RedirectResponse;

class GenericBtn extends Component
{
    public string $route;
    public string $name;
    public ?ButtonVariant $variant;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string|object $route, 
        string $name,
        ?string $variant = null
    )
    {
        $route instanceof RedirectResponse 
            ? $this->route = $route->getTargetUrl()
            : $this->route = (String)$route;

        $this->name = $name;
        $this->variant = ButtonVariant::tryFrom($variant) ?? ButtonVariant::CREATE;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.generic-btn'); 
    }
}