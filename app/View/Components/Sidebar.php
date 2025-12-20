<?php

namespace App\View\Components;

use App\Constants\AdminMenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $items;

    public function __construct()
    {
        // On récupère le menu et on le transforme immédiatement
        $this->items = $this->prepareMenu(AdminMenu::all());
    }

    /**
     * Ajoute les propriétés calculées (isActive, url) à chaque item
     */
    private function prepareMenu(array $menuItems): array
    {
        return array_map(function ($item) {
            $routeName = $item['route'] ?? null;
            
            //Calcul de l'URL (Gestion de la sécurité Route::has)
            $item['url'] = '#';
            if ($routeName && Route::has($routeName)) 
                $item['url'] = route($routeName);

            //Calcul de l'état Actif
            $item['isActive'] = false;
            
            if ($routeName && $routeName === 'admin.index') {
                $item['isActive'] = request()->routeIs($routeName);
            } else {
                $wildcard = Str::replaceLast('.index', '.*', $routeName);
                $item['isActive'] = request()->routeIs($wildcard) || request()->routeIs($routeName);
            }

            return $item;
        }, $menuItems);
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}