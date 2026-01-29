@include('Layouts.CRUD.index', [
    'pageTitle' => 'Classes',
    'headerTitle' => 'Gestion des classes',
    'headerIcon' => 'bi bi-journal-text',

    'createButton' => [
        'route' => 'admin.classrooms.create',
        'label' => 'Nouvelle classe'
    ],

    'table' => [
        'title' => 'Liste des classes',
        'columns' => ['name' => 'Nom', 'description' => 'Description'],
        'routeShow' => 'admin.classrooms.show',
        'routeDelete' => 'admin.classrooms.destroy',
    ],

    'items' => $classrooms,
    'errorMessage' => $errorMessage ?? null,
])