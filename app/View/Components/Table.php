<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public string $tableTitle;
    public array $rows;
    public array $data;

    /**
     * Create a new component instance.
     */
    public function __construct(string $tableTitle, array $rows, array $data)
    {
        $this->tableTitle = $tableTitle;
        $this->rows = $rows;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table', [
            'tableTitle' => $this->tableTitle,
            'rows' => $this->rows,
            'data' => $this->data
        ]);
    }
}
