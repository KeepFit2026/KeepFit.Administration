@include('Layouts.CRUD.create', [
    'pageTitle' => 'Créer un utilisateur',
    'headerTitle' => 'Créer un nouvel utilisateur',
    'customCss' => ['assets/css/exercises/create.css'],

    'breadcrumb' => [
        ['route' => 'admin.users.index', 'label' => 'Gestion des utilisateurs', 'icon' => 'bi bi-house-door'],
        ['label' => 'Créer un utilisateur']
    ],

    'formAction' => route('admin.users.store'),
    'formMethod' => 'POST',
    'formBadge' => ['icon' => 'bi bi-plus-circle', 'label' => 'Nouvel utilisateur'],
    'formTitle' => 'Informations de l\'utilisateur',

    'fields' => [
        [
            'name' => 'email',
            'label' => 'Email de l\'utilisateur',
            'type' => 'text',
            'placeholder' => 'Ex: test@gmail.com',
            'required' => true
        ],
        [
            'name' => 'role',
            'label' => 'Rôle',
            'type' => 'select',
            'required' => true,
            'options' => [
                '2' => 'Administrateur',
                '1' => 'Etudiant',
                '3' => 'Professeur'
            ]
        ]
    ],

    'createRoute' => 'admin.users.store',

    'sidebar' => [
        'title' => 'Champs requis',
        'items' => [
            ['label' => 'Email du l\'utilisateur', 'icon' => 'bi bi-check-circle-fill', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
            ['label' => 'role de l\'utilisateur ', 'icon' => 'bi bi-check-circle-fill', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
        ]
    ]
])