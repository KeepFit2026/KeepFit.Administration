<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButton extends Component
{

    public string $route;
    public string $name;

    /**
     * Create a new component instance.
     */
    public function __construct(string $route, string $name)
    {
        $this->route = $route;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-button');
    }
}
