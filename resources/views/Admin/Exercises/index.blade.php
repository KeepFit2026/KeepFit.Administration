@include('Layouts.CRUD.index', [
    'pageTitle' => 'Exercices',
    'headerTitle' => 'Gestion des exercices',
    'headerIcon' => 'bi bi-journal-text',

    'createButton' => [
        'route' => 'admin.exercises.create',
        'label' => 'Nouvel exercice'
    ],

    'table' => [
        'title' => 'Liste des exercices',
        'columns' => ['Name', 'Description', 'Actions'],
        'routeShow' => 'admin.exercises.show',
        'routeDelete' => 'admin.exercises.destroy'
    ],

    'stats' => [
        [
            'name' => 'Total des exercices',
            'data' => count($exercises),
            'subname' => 'Exercices créés'
        ],
        [
            'name' => 'Exercices terminés',
            'data' => 0,
            'subname' => 'Terminés',
            'class' => 'success'
        ]
    ],

    'items' => $exercises,
    'errorMessage' => $errorMessage ?? null,
])