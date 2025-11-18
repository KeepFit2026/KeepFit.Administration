<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardInformation extends Component
{
    public string $name;
    public int $data;
    public string $class;
    public string $subname;

    /**
     * Create a new component instance.
     */

    public function __construct(string $name, int $data, string $class = '', string $subname = '')
    {
        $this->name = $name;
        $this->data = $data;
        $this->class = $class;
        $this->subname = $subname;
    } 

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-information', [
            'name' => $this->name,
            'data' => $this->data
        ]);
    }
}
