<?php

namespace App\View\Components;

use App\Constants\AdminMenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{

    public array $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = AdminMenu::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
