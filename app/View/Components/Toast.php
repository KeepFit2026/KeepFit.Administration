<?php

namespace App\View\Components;

use App\Constants\Enum\ToastType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    public string $message = '';
    public string $type = 'info';
    public string $title = 'Notification';
    public string $icon = 'bi-info-circle';

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // On parcourt tous les types définis dans l'Enum pour trouver le bon
        foreach (ToastType::cases() as $enum) {
            // On vérifie si une clé de session correspond à la valeur de l'enum (ex: 'success', 'error')
            if (session()->has($enum->value)) {
                $this->message = session($enum->value);
                // On récupère toutes les propriétés d'affichage
                $this->type = $enum->color(); 
                $this->title = $enum->title();
                $this->icon = $enum->icon();
                break;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toast');
    }
}