@include('Layouts.CRUD.create', [
    'pageTitle' => 'Créer un programme',
    'headerTitle' => 'Créer un nouvel programme',
    'customCss' => ['assets/css/exercises/create.css'],

    'breadcrumb' => [
        ['route' => 'admin.programs.index', 'label' => 'Gestion des programmes', 'icon' => 'bi bi-house-door'],
        ['label' => 'Créer un programme']
    ],

    'formAction' => route('admin.programs.store'),
    'formMethod' => 'POST',
    'formBadge' => ['icon' => 'bi bi-plus-circle', 'label' => 'Nouvel exercice'],
    'formTitle' => "Informations du programme",

    'fields' => [
        [
            'name' => 'name',
            'label' => 'Nom du programme',
            'type' => 'text',
            'placeholder' => 'Ex: Programme débutant... ',
            'required' => true
        ],
        [
            'name' => 'description',
            'label' => 'Description détaillée',
            'type' => 'textarea',
            'rows' => 6,
            'placeholder' => 'Décrivez le programme en détail...',
            'required' => true
        ]
    ],

    'cancelRoute' => route('admin.programs.index'),
    'cancelLabel' => 'Annuler',
    'submitLabel' => 'Créer le programme',
    'submitIcon' => 'bi bi-check-lg',

    'sidebar' => [
        'title' => 'Champs requis',
        'items' => [
            ['label' => 'Nom du programme', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
            ['label' => 'Description', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
        ]
    ]
])