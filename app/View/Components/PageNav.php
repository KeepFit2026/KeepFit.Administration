<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class PageNav extends Component
{
    public array $items;
    public string $routePrefix;

    /**
     * Create a new component instance.
    */
    public function __construct(
        array $items = [], 
        string $routePrefix = '')
    {
        $this->items = $this->processItems($items, $routePrefix);
        $this->routePrefix = $routePrefix;
    }

    private function processItems(array $items, string $prefix): array
    {
        if (empty($prefix)) {
            return $items;
        }

        return array_map(function ($item) use ($prefix) {
            if (isset($item['route']) && !empty($item['route'])) {

                // Ne pas ajouter le préfixe si la route commence déjà par lui
                if (!str_starts_with($item['route'], $prefix . '.')) {
                    $item['route'] = $prefix . '.' . $item['route'];
                }
            }
            return $item;
        }, $items);
    }


    /**
     * Get route URL with params
     */
    public function getRouteUrl(array $item): string
    {
        if (!isset($item['route']) || !Route::has($item['route'])) {
            return '#';
        }

        $params = $item['params'] ?? [];
        return route($item['route'], $params);
    }

    /**
     * Get the view / contents that represent the component.
    */
    public function render(): View|Closure|string
    {
        return view('components.page-nav');
    }
}
