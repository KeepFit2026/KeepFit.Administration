<?php

namespace App\View\Components;

use App\Constants\Enum\TableVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public string $tableTitle;
    public array $rows;
    public array $data;
    public string $routeShow;
    public ?string $routeDelete;
    public ?TableVariant $variant;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $tableTitle, 
        array $rows, 
        ?array $data, 
        string $routeShow, 
        ?string $routeDelete = null,
        ?String $variant = 'default'
        )
    {
        $this->tableTitle = $tableTitle;
        $this->rows = $rows;
        $this->data = $data ?? [];
        $this->routeShow = $routeShow;
        $this->routeDelete = $routeDelete;
        
        //TODO Me trouve pas la bonne variante
        $this->variant = TableVariant::tryFrom($variant) ?? TableVariant::DEFAULT;
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
            'routeDelete'   => $this->routeDelete,
            'variant'       => $this->variant
        ]);
    }
}
