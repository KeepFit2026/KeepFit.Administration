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
            'submenu' => [
                [
                    'title' => 'Créer un utilisateur',
                    'route' => 'admin.users.create'
                ],
                [
                    'title' => 'Liste des utilisateurs',
                    'route' => 'admin.users.index'
                ],
            ]
        ],
        [
            'title' => 'Classes',
            'icon' => 'fa-chisel fa-regular fa-suitcase',
            'submenu' => [
                [
                    'title' => 'Créer une classes',
                ],
                [
                    'title' => 'Liste des classes',
                ],
            ]
        ],
        
        [
            'title' => 'Exercices',
            'icon' => 'fas fa-running',
            'route' => 'admin.exercises.index',
            'submenu' => [
                [
                    'title' => 'Listes des exercices',
                    'route' => 'admin.exercises.index'
                ],
                [
                    'title' => 'Créer',
                    'route' => 'admin.exercises.create'
                ]
            ]
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