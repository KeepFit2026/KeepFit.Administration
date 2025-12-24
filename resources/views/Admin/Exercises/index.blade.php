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
        'columns' => ['name' => 'Nom', 'description' => 'Description'],
        'routeShow' => 'admin.exercises.show',
        'routeDelete' => 'admin.exercises.destroy',
    ],

    'items' => $exercises,
    'errorMessage' => $errorMessage ?? null,
])