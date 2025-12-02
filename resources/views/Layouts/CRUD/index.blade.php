<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin KeepFit - {{ $pageTitle ?? 'Page' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/components/page-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/entity/index.css') }}">
</head>

<body>
    <div class="admin-container">
        
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
                        <span class="user-name">{{ $currentUser ?? 'Invité' }}</span>
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
                            <i class="{{ $headerIcon ?? 'bi bi-journal-text' }}"></i> 
                            {{ $headerTitle ?? 'Titre' }}
                        </h1>

                        @if(!empty($createButton))
                            <x-create-button 
                                :route="$createButton['route']" 
                                :name="$createButton['label']"
                            />
                        @endif
                    </div>

                    @if(!empty($stats))
                        <div class="stats-grid-entity">
                            @foreach ($stats as $stat)
                                <x-card-information
                                    :name="$stat['name']"
                                    :data="$stat['data']"
                                    :subname="$stat['subname']"
                                    :class="$stat['class'] ?? ''"
                                />
                            @endforeach
                        </div>
                    @endif

                    @if(!empty($errorMessage))
                        <x-alert-message :errorMessage="$errorMessage" />
                    @else

                        @if(empty($items))
                            <div class="empty-state">
                                <i class="bi bi-journal-x"></i>
                                <h3>Aucun élément trouvé</h3>
                                <p>Commencez par en créer un</p>
                            </div>
                        @else
                            @php
                                $table = $table ?? ['title' => 'Liste', 'columns' => []];
                            @endphp

                            <x-table
                                :tableTitle="$table['title']"
                                :rows="$table['columns']"
                                :data="$items"
                                :routeShow="$table['routeShow']"
                                :routeDelete="$table['routeDelete']"
                            />
                        @endif
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>