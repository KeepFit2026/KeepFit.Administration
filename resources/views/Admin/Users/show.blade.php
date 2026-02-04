@include('Layouts.CRUD.show', [
    'pageTitle' => $users['name'] ?? 'Utilisateur',

    'breadcrumb' => [
        ['route' => 'admin.users.index', 'label' => 'Gestion des étudiants', 'icon' => 'bi bi-people'],
        ['label' => $users['name'] ?? 'Détails']
    ],

    'entity' => $users, 
    
    'tableTitle' => 'CLASSES INSCRITES',

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
            'title' => 'Informations personnelles',
            'items' => [
                [
                    'label' => 'Email',
                    'value' => $users['email'] ?? 'Non renseigné', 
                    'icon' => 'bi bi-envelope'
                ],
                [
                    'label' => 'Téléphone',
                    'value' => $users['phone_number'] ?? 'Non renseigné',
                    'icon' => 'bi bi-telephone'
                ],
                [
                    'label' => 'Rôle',
                    'value' => '<span class="badge bg-primary">'.($users['roleName'] ?? 'Membre').'</span>',
                    'icon' => 'bi bi-shield-lock'
                ]
            ]
        ],
        [
            'title' => 'Actions',
            'listClass' => 'quick-actions',
            'items' => [
                [
                    'label' => '',
                    'value' => route('admin.users.addUserToClassroom', $users['id']), 
                    'icon' => 'bi bi-journal-plus',
                    'text' => "Inscrire à une nouvelle classe"
                ],
            ]
        ]
    ]
])