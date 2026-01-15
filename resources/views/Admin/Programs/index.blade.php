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
        'columns' => ['name' => 'Nom', 'description' => 'Description'],
        'routeShow' => 'admin.programs.show',
        'routeDelete' => 'admin.programs.destroy',
    ],

    'items' => $programs,
    'errorMessage' => $errorMessage ?? null,
])