@include('Layouts.CRUD.show', [
    'pageTitle' => $classrooms['name'],

    'breadcrumb' => [
        ['route' => 'admin.classrooms.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
        ['label' => $classrooms['name']]
    ],

    'entity' => $classrooms, 
    'showAddToProgram' => true,

    'relations' => [
        'title' => 'Utilisateur incluant cette classe',
        'icon' => 'bi bi-journal-bookmark-fill',
        'headers' => ['Nom de l\'utilisateur'],
        'fields' => ['name'],
        'data' => $classrooms['users'] ?? [],
        'base_route' => 'admin.users.show'
    ],

    'tableTitle' => 'UTILISATEURS ASSOCIÉS',

    'table' => [
        'title' => 'Liste des classes',
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
                    'value' => $classrooms['category'] ?? 'Non définie',
                    'icon' => 'bi bi-diagram-3'
                ],
                [
                    'label' => 'Difficulté',
                    'value' => $classrooms['difficulty'] ?? 'Non définie',
                    'icon' => 'bi bi-speedometer2'
                ]
            ]
        ],
        [
            'title' => 'Actions rapides',
            'listClass' => 'quick-actions',
            'items' => [
                [
                    'label' => '',
                    'value' => '',
                    'icon' => 'bi bi-files',
                    'text' => "Modifier l'exercice"
                ],
                [
                    'label' => '',
                    'value' => '',
                    'icon' => 'bi bi-printer',
                    'text' => "Exporter en PDF"
                ]
            ]
        ]
    ]
])