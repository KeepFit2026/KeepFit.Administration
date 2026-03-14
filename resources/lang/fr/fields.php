<?php

return [
    'name' => 'Nom',
    'email' => 'Email',
    'description' => 'Description',
    'role' => 'Role',
    'created_at' => 'Date de création',

    'navigation' => [
        'training' => 'Entrainement'
    ],

    'exercise' => [
        'name' => 'Nom de l\'exercice',
        'description' => 'Description',
        'muscle_group' => 'Groupe musculaire',
        'difficulty' => 'Niveau de difficulté',
        'sections' => [
            'general' => 'Informations Générales',
            'general_desc' => 'Définissez l\'identité de cet exercice.',
            'settings' => 'Détails',
        ],

        'header_btn' => 'Créer un nouvel exercice'
    ],

    'programs' => [
        'name' => 'Nom du programme',
        'description' => 'Description du programme',
        'isActive' => 'Actif',
        'header_action' => 'Créer un programme',
         'sections' => [
            'general' => 'Informations Générales',
            'general_desc' => 'Définissez l\'identité de ce programme.',
            'settings' => 'Détails',
            'isActive' => 'Est-ce que le programme est actif ?'
        ],
    ],

    'muscular_group' => [
        'name' => 'Groupe',
        'header_btn' => 'Créer un nouveau groupe'
    ],

    'login' => [
        'header_action' => 'Créer un compte de connexion',
    ],

    'classrooms' => [
        'header_action' => 'Créer une nouvelle classe'
    ],

    'difficulty' => [
        'header_action' => 'Créer une nouvelle difficulté'
    ],

    'roles' => [
        'header_action' => 'Créer un nouveau rôle'
    ],

    'export' => [
        'name' => 'Nom du fichier'
    ]
];