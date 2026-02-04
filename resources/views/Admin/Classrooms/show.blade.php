@include('Layouts.CRUD.show', [
    'pageTitle' => $classrooms['name'],

    'breadcrumb' => [
        ['route' => 'admin.classrooms.index', 'label' => 'Gestion des classes', 'icon' => 'bi bi-house-door'],
        ['label' => $classrooms['name']]
    ],

    'entity' => $classrooms, 

    'tableTitle' => 'UTILISATEURS ASSOCIÉS',

    'table' => [
        'title' => 'Liste des classes suivies',
        'icon'  => 'bi bi-easel', 
        'columns' => [
            'Nom de la classe' => 'name', 
        ], 
        
        'routeShow' => 'admin.classrooms.show', 
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