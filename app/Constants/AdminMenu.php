<?php

namespace App\Constants;

class AdminMenu
{
    private static array $menu = [
        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'admin.index'
        ],
        [
            'title' => 'Utilisateurs',
            'icon' => 'fas fa-users',
        ],
        [
            'title' => 'Exercices',
            'icon' => 'fas fa-running',
            'route' => 'admin.exercises.index'
        ],
        [
            'title' => 'Programmes',
            'icon' => 'fas fa-dumbbell',
            'route' => 'admin.programs.index'
        ],
        [
            'title' => 'Séances',
            'icon' => 'fas fa-calendar-alt',
        ],
        [
            'title' => 'Statistiques',
            'icon' => 'fas fa-chart-bar',
        ],
        [
            'title' => 'Paramètres',
            'icon' => 'fas fa-cog',
        ],
    ];

    public static function all(): array
    {
        return self::$menu;
    }
}