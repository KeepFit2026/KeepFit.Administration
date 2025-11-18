<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin KeepFit - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/components/page-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/entity/index.css') }}">
</head>
<body>
    <div class="admin-container">
       
        {{-- Composant sidebar --}}
        <x-sidebar/>

        <div class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <button class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="header-right">
                    <div class="user-menu">
                        <span class="user-name">{{ $user ?? 'Invité' }}</span>
                        <div class="user-avatar">
                            <img src="{{ asset('assets/img/pp-default.png') }}" alt="Avatar utilisateur" />
                        </div>
                    </div>
                </div>
            </header>

            <main class="content">
                <div class="container-fluid entity-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-journal-text"></i> @yield("header-title", "Titre")
                        </h1>
                        @yield('header')
                    </div>

                    <div class="stats-grid-entity">
                        @yield('statistiques')
                    </div>

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>