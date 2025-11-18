@include('Layouts.CRUD.show', [
    'pageTitle' => $programs['name'],
    'customCss' => ['assets/css/exercises/show.css'],

    'breadcrumb' => [
        ['route' => 'admin.programs.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
        ['label' => $programs['name']]
    ],

    'entity' => $programs, 

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
                    'label' => 'Difficulté',
                    'value' => $programs['difficulty'] ?? 'Non définie',
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
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-files"></i> Modifier l\'exercice</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-printer"></i> Exporter en PDF</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-share"></i> Supprimer l\'exercice</a>'
                ]
            ]
        ]
    ]
])