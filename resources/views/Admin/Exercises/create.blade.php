@include('Layouts.CRUD.create', [
    'pageTitle' => 'Créer un exercice',
    'headerTitle' => 'Créer un nouvel exercice',
    'customCss' => ['assets/css/exercises/create.css'],

    'breadcrumb' => [
        ['route' => 'admin.exercises.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
        ['label' => 'Créer un exercice']
    ],

    'formAction' => route('admin.exercises.store'),
    'formMethod' => 'POST',
    'formBadge' => ['icon' => 'bi bi-plus-circle', 'label' => 'Nouvel exercice'],
    'formTitle' => "Informations de l'exercice",

    'fields' => [
        [
            'name' => 'name',
            'label' => 'Nom de l\'exercice',
            'type' => 'text',
            'placeholder' => 'Ex: Développé couché, Squat...',
            'required' => true
        ],
        [
            'name' => 'description',
            'label' => 'Description détaillée',
            'type' => 'textarea',
            'rows' => 6,
            'placeholder' => 'Décrivez l\'exercice en détail...',
            'required' => true
        ]
    ],

    'cancelRoute' => route('admin.exercises.index'),
    'cancelLabel' => 'Annuler',
    'submitLabel' => 'Créer l\'exercice',
    'submitIcon' => 'bi bi-check-lg',

    'sidebar' => [
        'title' => 'Champs requis',
        'items' => [
            ['label' => 'Nom de l\'exercice', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
            ['label' => 'Description', 'description' => 'Obligatoire', 'icon' => 'bi bi-check-circle-fill'],
        ]
    ]
])