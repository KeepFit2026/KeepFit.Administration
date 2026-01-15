@include('Layouts.CRUD.show', [
    'pageTitle' => $users['name'],
    'customCss' => ['assets/css/exercises/show.css'],

    'breadcrumb' => [
        ['route' => 'admin.users.index', 'label' => 'Gestion des utilisateurs', 'icon' => 'bi bi-house-door'],
        ['label' => $users['name']]
    ],

    'entity' => $users, 

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
                    'label' => 'role',
                    'value' => $users['roleName'] ?? 'Non définie',
                    'icon' => 'bi bi-diagram-3'
                ],
            ]
        ],
        [
            'title' => 'Actions rapides',
            'listClass' => 'quick-actions',
            'items' => [
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-files"></i> Modifier l\'utilisateur</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-printer"></i> Exporter en PDF</a>'
                ],
                [
                    'label' => '',
                    'value' => '<a href="#" class="action-btn"><i class="bi bi-trash"></i> Supprimer le l\'utilisateur</a>'
                ]
            ]
        ]
    ]
])