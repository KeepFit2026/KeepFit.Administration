@include('Layouts.CRUD.index', [
    'pageTitle' => 'Programmes',
    'headerTitle' => 'Gestion des programmes',
    'headerIcon' => 'bi bi-journal-text',

    'createButton' => [
        'route' => 'admin.programs.create',
        'label' => 'Nouveau programme'
    ],

    'table' => [
        'title' => 'Liste des programmes',
        'columns' => ['Name', 'Description', 'Actions'],
        'routeShow' => 'admin.programs.show',
        'routeDelete' => 'admin.programs.destroy'
    ],

    'stats' => [
        [
            'name' => 'Total des programmes',
            'data' => count($programs),
            'subname' => 'programmes créés'
        ],
        [
            'name' => 'programmes terminés',
            'data' => 0,
            'subname' => 'Terminés',
            'class' => 'success'
        ]
    ],

    'items' => $programs,
    'errorMessage' => $errorMessage ?? null,
])