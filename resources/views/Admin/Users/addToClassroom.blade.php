@extends('Layouts.admin')

@section('title', 'Ajouter à une classe')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/show.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/addToProgram.css') }}">
@endsection

@section('content')
@php
    $count = isset($classrooms['data']) && $classrooms['data'] != null ? count($classrooms['data']) : 0;
    
    $userName = $user['data']['name'] ?? 'Utilisateur inconnu';
@endphp

<div class="container-fluid exercises-section">
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                <x-page-nav 
                    route-prefix="admin.users"
                    :items="[
                        ['route' => 'index', 'label' => 'Gestion des utilisateurs', 'icon' => 'bi bi-people'],
                        ['route' => 'show', 'label' => $userName, 'params' => ['user' => $user['data']['id']]],
                        ['label' => 'Inscription classe']
                    ]" 
                />
            </div>
            <h1 class="page-title">
                <i class="bi bi-person-plus"></i> Inscrire <i>{{ $userName }}</i>
            </h1>
        </div>
    </div>

    <div class="layout-container">
        <div class="exercise-sidebar">
            <div class="exercise-card">
                <div class="exercise-header">
                    <div class="icon-box">
                        @if(isset($user['data']['profile_picture']) && $user['data']['profile_picture'])
                            <img src="{{ $user['data']['profile_picture'] }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            <i class="bi bi-person"></i>
                        @endif
                    </div>
                    <h3>{{ $userName }}</h3>
                </div>
                <div class="exercise-body">
                    <div class="exercise-category">
                        <i class="bi bi-envelope me-2"></i>{{ $user['data']['email'] ?? 'Email non renseigné' }}
                    </div>
                    
                    <div class="exercise-stats">                
                        <div class="stat-badge">
                            <div class="stat-icon"><i class="bi bi-telephone"></i></div>
                            <div class="stat-content">
                                <h5>Téléphone</h5>
                                <p>{{ $user['data']['phone_number'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="stat-badge">
                            <div class="stat-icon"><i class="bi bi-shield-lock"></i></div>
                            <div class="stat-content">
                                <h5>Rôle</h5>
                                <p>{{ $user['data']['roleName'] ?? 'Membre' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="options-main">
            <form action="{{ route('admin.users.post.addUserToClassroom', $user['data']['id']) }}" method="POST">
                @csrf
                
                <div class="options-header">
                    <h2><i class="bi bi-easel"></i> Choisir une classe</h2>
                    <span class="options-count">{{ $count }} disponibles</span>
                </div>

                <div class="search-filters">
                    <div class="search-box" style="width: 100%;">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une classe...">
                    </div>
                </div>

                <div class="programs-list-section">
                    @if( $count > 0)
                        <div class="programs-list">
                            @foreach($classrooms['data'] as $classroom)
                                <label class="program-row" for="classroom_{{ $classroom['id'] }}">
                                    <input type="radio" 
                                           name="classroom_id" 
                                           id="classroom_{{ $classroom['id'] }}" 
                                           value="{{ $classroom['id'] }}" 
                                           class="program-radio"
                                           required>
                                    
                                    <div class="program-row-content">
                                        <div class="row-icon">
                                            <i class="bi bi-collection"></i>
                                        </div>
                                        
                                        <div class="row-info">
                                            <div class="program-name">
                                                <h6 class="mb-1">{{ $classroom['name'] }}</h6>
                                                @if(isset($classroom['coach_name']))
                                                    <span class="program-category">
                                                        Coach: {{ $classroom['coach_name'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="row-stats">
                                            <div class="stats-item">
                                                <i class="bi bi-clock"></i>
                                                <span>{{ $classroom['schedule_time'] ?? 'N/A' }}</span>
                                            </div>
                                            <div class="stats-item">
                                                <i class="bi bi-people"></i>
                                                <span>{{ $classroom['users_count'] ?? 0 }} / {{ $classroom['capacity'] ?? 20 }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row-action">
                                            <span class="select-indicator"><i class="bi bi-check-circle"></i></span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @if(isset($classrooms['data']->links))
                            <div class="programs-pagination">
                                {{ $classrooms['data']->links() }}
                            </div>
                        @elseif($classrooms['data'] instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="programs-pagination">
                                {{ $classrooms['data']->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <i class="bi bi-slash-circle mb-3 fs-1 text-muted"></i>
                            <h4>Aucune classe disponible</h4>
                        </div>
                    @endif
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.users.show', $user['data']['id']) }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>

                    <form action="{{ route('admin.users.post.addUserToClassroom', $user['data']['id'], ) }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="bi bi-check-circle"></i>
                            Inscrire l'étudiant
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
    
    <x-toast />
</div>

@endsection