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
    public string $routeShow;
    public string $routeDelete;

    /**
     * Create a new component instance.
     */
    public function __construct(string $tableTitle, array $rows, array $data, string $routeShow, string $routeDelete)
    {
        $this->tableTitle = $tableTitle;
        $this->rows = $rows;
        $this->data = $data;
        $this->routeShow = $routeShow;
        $this->routeDelete = $routeDelete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table', [
            'tableTitle'    => $this->tableTitle,
            'rows'          => $this->rows,
            'data'          => $this->data,
            'routeShow'     => $this->routeShow,
            'routeDelete'   => $this->routeDelete
        ]);
    }
}
