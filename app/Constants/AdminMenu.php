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
                    'route' => 'admin.classrooms.create'
                ],
                [
                    'title' => 'Liste des classes',
                    'route' => 'admin.classrooms.index'
                ],
            ]
        ],
        
        [
            'title' => 'Exercices',
            'icon' => 'fas fa-running',
            'submenu' => [
                [
                    'title' => 'Créer un exercices',
                    'route' => 'admin.exercises.create'
                ],
                [
                    'title' => 'Listes des exercices',
                    'route' => 'admin.exercises.index'
                ]
            ]
        ],
        [
            'title' => 'Programmes',
            'icon' => 'fas fa-dumbbell',
            'submenu' => [
                [
                    'title' => 'Créer un programme',
                    'route' => 'admin.programs.create'
                ],
                [
                    'title' => 'Listes des programmes',
                    'route' => 'admin.programs.index'
                ]
            ]
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
        [
            'title' => 'Messages',
            'icon' => 'fas fa-comments',
            'route' => 'admin.chat'
        ],
        
    ];

    public static function all(): array
    {
        return self::$menu;
    }
}