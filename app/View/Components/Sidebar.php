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
            $item['isActive'] = false;
            $item['url'] = '#';

            // CAS 1 : C'est un groupe
            if (isset($item['submenu']) && is_array($item['submenu'])) {
                // On rappelle la fonction sur les enfants (récursivité)
                $item['submenu'] = $this->prepareMenu($item['submenu']);
                
                // Si un des enfants est actif, le parent devient actif (pour rester ouvert)
                foreach ($item['submenu'] as $subItem) {
                    if ($subItem['isActive']) {
                        $item['isActive'] = true;
                        break;
                    }
                }
            } 
            
            // CAS 2 : C'est un lien simple
            else {
                $routeName = $item['route'] ?? null;
                
                if ($routeName && Route::has($routeName)) {
                    $item['url'] = route($routeName);
                }

                if ($routeName) {
                    if ($routeName === 'admin.index') {
                        $item['isActive'] = request()->routeIs($routeName);
                    } else {
                        $wildcard = Str::replaceLast('.index', '.*', $routeName);
                        $item['isActive'] = request()->routeIs($wildcard) || request()->routeIs($routeName);
                    }
                }
            }

            return $item;
        }, $menuItems);
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}