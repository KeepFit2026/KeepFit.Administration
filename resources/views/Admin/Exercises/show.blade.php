@include('Layouts.CRUD.show', [
    'pageTitle' => $exercises['name'],

    'breadcrumb' => [
        ['route' => 'admin.exercises.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
        ['label' => $exercises['name']]
    ],

    'entity' => $exercises, 
    'showAddToProgram' => true,

    'relations' => [
        'title' => 'Programmes incluant cet exercice',
        'icon' => 'bi bi-journal-bookmark-fill',
        'headers' => ['Nom du programme', 'Niveau', 'Durée'],
        'fields' => ['name', 'level', 'duration'],
        'data' => $exercises['programs'] ?? [],
        'base_route' => 'admin.programs.show'
    ],

    'tableTitle' => 'PROGRAMMES ASSOCIÉS',

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
                    'value' => $exercises['category'] ?? 'Non définie',
                    'icon' => 'bi bi-diagram-3'
                ],
                [
                    'label' => 'Difficulté',
                    'value' => $exercises['difficulty'] ?? 'Non définie',
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
                ],
                [
                    'label' => '',
                    'value' => route('admin.exercises.addToProgramPage', $exercises['id']),
                    'icon' => 'bi bi-share',
                    'text' => "Ajouter à un programme"
                ]
            ]
        ]
    ]
])