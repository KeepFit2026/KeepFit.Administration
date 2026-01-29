@include('Layouts.CRUD.create', [
    'pageTitle' => 'Créer une classe',
    'headerTitle' => 'Créer une nouvelle classe',
    'customCss' => ['assets/css/exercises/create.css'],

    'breadcrumb' => [
        ['route' => 'admin.classrooms.index', 'label' => 'Gestion des classes', 'icon' => 'bi bi-house-door'],
        ['label' => 'Créer une classe']
    ],

    'formAction' => route('admin.classrooms.store'),
    'formMethod' => 'POST',
    'formBadge' => ['icon' => 'bi bi-plus-circle', 'label' => 'Nouvelle classe'],
    'formTitle' => "Informations de la classe",

    'fields' => [
        [
            'name' => 'name',
            'label' => 'Nom de la classe',
            'type' => 'text',
            'placeholder' => 'Ex: BTS SIO',
            'required' => true
        ]
    ],

    'createRoute' => 'admin.classrooms.store',
    'submitIcon' => 'bi bi-check-lg',

    'sidebar' => [
        'title' => 'Champs requis',
        'items' => [
            ['label' => 'Nom de la classe', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
        ]
    ]
])