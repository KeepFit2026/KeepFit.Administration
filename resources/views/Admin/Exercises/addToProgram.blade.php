@extends('Layouts.admin')

@section('title', 'Ajouter à un programme')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/show.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/addToProgram.css') }}">
@endsection

@section('content')

<div class="container-fluid exercises-section">
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                <x-page-nav 
                    route-prefix="admin.exercises"
                    :items="[
                        [
                            'route' => 'index',
                            'label' => 'Gestion des exercices',
                            'icon'  => 'bi bi-house-door'
                        ],
                        [
                            'route' => 'show',
                            'label' => $exercise['data']['name'],
                            'params' => ['exercise' => $exercise['data']['id']]
                        ],
                        [
                            'label' => 'Ajouter à un programme'
                        ]
                    ]" 
                />
            </div>
            <h1 class="page-title">
                 <i class="bi bi-plus-circle"></i> Ajouter <i>"{{ $exercise['data']['name'] }}"</i> à un programme
            </h1>
        </div>
    </div>

    <div class="layout-container">
        <div class="exercise-sidebar">
            <div class="exercise-card">
                <div class="exercise-header">
                    <div class="icon-box">
                        <i class="bi bi-dumbbell"></i>
                    </div>
                    <h3>{{ $exercise['data']['name'] }}</h3>
                </div>
                <div class="exercise-body">
                    <div class="exercise-category">
                        <i class="bi bi-tag me-2"></i>{{ $exercise['data']['category'] ?? 'N/A' }}
                    </div>
                    
                    <div class="exercise-stats">                
                        <div class="stat-badge">
                            <div class="stat-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Durée estimée</h5>
                                <p>{{ $exercise['data']['duration'] ?? '5-10 min' }}</p>
                            </div>
                        </div>
                        
                        <div class="stat-badge">
                            <div class="stat-icon">
                                <i class="bi bi-muscle"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Groupes musculaires</h5>
                                <p>{{ $exercise['data']['muscle_groups'] ?? 'Multiple' }}</p>
                            </div>
                        </div>
                        
                        <div class="stat-badge">
                            <div class="stat-icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Type d'exercice</h5>
                                <p>{{ $exercise['data']['type'] ?? 'Force' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($exercise['data']['description']) && $exercise['data']['description'])
                        <div class="exercise-description">
                            <h6>Description</h6>
                            <p>{{ $exercise['data']['description'] }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE : Options d'ajout -->
        <div class="options-main">
            <form action="" method="POST">
                @csrf
                
                <!-- En-tête -->
                <div class="options-header">
                    <h2>
                        <i class="bi bi-clipboard-check"></i>
                        Choisir un programme
                    </h2>
                    <span class="options-count">
                        <i class="bi bi-list-check"></i>
                        {{ count($programs['data']) }} programmes disponibles
                    </span>
                </div>

                <div class="search-filters">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Rechercher un programme par nom, catégorie...">
                    </div>
                    <div class="filters-row">
                        <div class="filter-group">
                            <label for="category">
                                <i class="bi bi-funnel me-1"></i>Catégorie
                            </label>
                            <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les catégories</option>
                                <option value="musculation" {{ request('category') == 'musculation' ? 'selected' : '' }}>Musculation</option>
                                <option value="cardio" {{ request('category') == 'cardio' ? 'selected' : '' }}>Cardio</option>
                                <option value="mobility" {{ request('category') == 'mobility' ? 'selected' : '' }}>Mobilité</option>
                                <option value="beginner" {{ request('category') == 'beginner' ? 'selected' : '' }}>Débutant</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="sort">
                                <i class="bi bi-sort-alpha-down me-1"></i>Trier par
                            </label>
                            <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom (Z-A)</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récent</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus ancien</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="programs-list-section">
                    <div class="programs-list-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-list-columns text-primary me-2"></i>
                            Liste des programmes
                        </h5>
                        <div class="list-info">
                            <span class="text-muted small">
                                Affichage {{ $programs['from'] ?? 1 }}-{{ $programs['to'] ?? count($programs['data']) }} sur {{ $programs['total'] ?? count($programs['data']) }}
                            </span>
                        </div>
                    </div>
                    
                    @if(count($programs['data']) > 0)
                        <div class="programs-list">
                            @foreach($programs['data'] as $program)
                                <label class="program-row" for="program_{{ $program['id'] }}">
                                    <input type="radio" 
                                           name="program_id" 
                                           id="program_{{ $program['id'] }}" 
                                           value="{{ $program['id'] }}" 
                                           class="program-radio">
                                    
                                    <div class="program-row-content">
                                        <div class="row-icon">
                                            @php
                                                $category = $program['category'] ?? 'general';
                                            @endphp
                                            @switch($category)
                                                @case('musculation')
                                                    <i class="bi bi-dumbbell"></i>
                                                    @break
                                                @case('cardio')
                                                    <i class="bi bi-heart-pulse"></i>
                                                    @break
                                                @case('mobility')
                                                    <i class="bi bi-arrow-repeat"></i>
                                                    @break
                                                @default
                                                    <i class="bi bi-calendar-check"></i>
                                            @endswitch
                                        </div>
                                        
                                        <div class="row-info">
                                            <div class="program-name">
                                                <h6 class="mb-1">{{ $program['name'] }}</h6>
                                                @if(isset($program['category']) && $program['category'])
                                                    <span class="program-category">{{ $program['category'] }}</span>
                                                @endif
                                            </div>
                                            
                                            @if(isset($program['description']) && $program['description'])
                                                <p class="program-desc">{{ Str::limit($program['description'], 80) }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="row-stats">
                                            <div class="stats-item">
                                                <i class="bi bi-clock"></i>
                                                <span>{{ $program['duration'] ?? '30' }} min</span>
                                            </div>
                                            <div class="stats-item">
                                                <i class="bi bi-list-check"></i>
                                                <span>{{ $program['exercise_count'] ?? '0' }} ex.</span>
                                            </div>
                                            <div class="stats-item">
                                                <i class="bi bi-person"></i>
                                                <span>{{ $program['participants'] ?? '0' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row-action">
                                            <span class="select-indicator">
                                                <i class="bi bi-check-circle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if(isset($programs['data']->links))
                            <div class="programs-pagination">
                                {{ $programs['data']->links() }}
                            </div>
                        @elseif($programs['data'] instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="programs-pagination">
                                {{ $programs['data']->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-clipboard-x"></i>
                            </div>
                            <h4>Aucun programme disponible</h4>
                            <p>Créez d'abord un programme avant d'y ajouter des exercices.</p>
                            <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Créer un nouveau programme
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Configuration -->
                <div class="config-section">
                    <h5 class="config-title">
                        <i class="bi bi-gear"></i>
                        Configuration dans le programme
                    </h5>
                    
                    <div class="config-grid">
                        <div class="config-group">
                            <label for="sets">
                                <i class="bi bi-123"></i>Nombre de séries
                            </label>
                            <input type="number" 
                                   name="sets" 
                                   id="sets" 
                                   min="1" 
                                   max="10" 
                                   value="3" 
                                   required>
                        </div>
                        
                        <div class="config-group">
                            <label for="reps">
                                <i class="bi bi-arrow-repeat"></i>Répétitions par série
                            </label>
                            <input type="text" 
                                   name="reps" 
                                   id="reps" 
                                   value="8-12" 
                                   placeholder="Ex: 8-12, 10">
                        </div>
                        
                        <div class="config-group">
                            <label for="rest_time">
                                <i class="bi bi-hourglass-split"></i>Temps de repos (sec)
                            </label>
                            <input type="number" 
                                   name="rest_time" 
                                   id="rest_time" 
                                   min="0" 
                                   max="300" 
                                   value="60">
                        </div>
                        
                        <div class="config-group">
                            <label for="order">
                                <i class="bi bi-sort-numeric-down"></i>Ordre dans le programme
                            </label>
                            <input type="number" 
                                   name="order" 
                                   id="order" 
                                   min="1" 
                                   value="1">
                        </div>
                    </div>
                    
                    <div class="notes-section">
                        <label for="notes" class="form-label fw-bold">
                            <i class="bi bi-pencil text-primary me-2"></i>
                            Notes supplémentaires
                        </label>
                        <textarea name="notes" 
                                  id="notes" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="Instructions spéciales, variantes, conseils..."></textarea>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="action-buttons">
                    <a href="{{ route('admin.exercises.show', $exercise['data']['id']) }}" 
                       class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Retour à l'exercice
                    </a>
                    
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i>
                        Ajouter au programme
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection