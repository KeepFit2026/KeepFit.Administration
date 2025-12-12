@include('Layouts.CRUD.show', [
    'pageTitle' => $programs['name'],
    'customCss' => ['assets/css/exercises/show.css'],

    'breadcrumb' => [
        ['route' => 'admin.programs.index', 'label' => 'Gestion des programmes', 'icon' => 'bi bi-house-door'],
        ['label' => $programs['name']]
    ],

    'entity' => $programs, 

    'relations' => [
        'title' => 'Exercices inclus dans ce programme',
        'icon' => 'bi bi-list-check',
        'headers' => ['Nom de l\'exercice', 'Catégorie', 'Difficulté'],
        'fields' => ['name', 'category', 'difficulty'],
        'data' => $programs['exercises'] ?? [],
        'base_route' => 'admin.exercises.show'
    ],

    'tableTitle' => 'EXERCICES ASSOCIÉS',

    'table' => [
        'title' => 'Liste des exercices',
        'columns' => ['Name', 'Description'],
        'routeShow' => 'admin.programs.show',
    ],

    'sidebar' => [
        [
            'title' => 'Informations',
            'items' => [
                [
                    'label' => 'Statut',
                    'value' => '<span class="status-badge active"><i class="bi bi-check-circle-fill"></i> Actif</span>',
                    'icon' => 'bi bi-tag'
                ],
                [
                    'label' => 'Catégorie',
                    'value' => $programs['category'] ?? 'Non définie',
                    'icon' => 'bi bi-diagram-3'
                ],
                [
                    'label' => 'Niveau',
                    'value' => $programs['level'] ?? 'Non défini',
                    'icon' => 'bi bi-bar-chart'
                ],
                [
                    'label' => 'Durée',
                    'value' => $programs['duration'] ?? 'Non définie',
                    'icon' => 'bi bi-clock'
                ]
            ]
        ],
        [
            'title' => 'Actions rapides',
            'listClass' => 'quick-actions',
            'items' => [
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-files"></i> Modifier le programme</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-printer"></i> Exporter en PDF</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-trash"></i> Supprimer le programme</a>'
                ]
            ]
        ]
    ]
])