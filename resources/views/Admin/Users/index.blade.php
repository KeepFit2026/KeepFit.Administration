@include('Layouts.CRUD.index', [
    'pageTitle' => 'Users',
    'headerTitle' => 'Gestion des utilisateurs',
    'headerIcon' => 'bi bi-journal-text',

    'createButton' => [
        'route' => 'admin.users.create',
        'label' => 'Nouvel utilisateur'
    ],

    'table' => [
        'title' => 'Liste des utilisateurs',
        'columns' => ['name' => 'Name', 'roleId' => 'Role ID'],
        'routeShow' => 'admin.users.show',
        'routeDelete' => 'admin.users.destroy',
    ],

    'items' => $users,
    'errorMessage' => $errorMessage ?? null,
]);