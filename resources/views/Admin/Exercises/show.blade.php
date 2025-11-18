@extends('Layouts.admin')

@section('title', $exercise['name'])

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/show.css') }}">
@endsection

@section('content')
<div class="container-fluid exercises-section">
    
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                
                <x-page-nav :items="[
                    ['route' => 'admin.exercises.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
                    ['label' => $exercise['name']]
                ]" />

            </div>
            <h1 class="page-title">{{ $exercise['name'] }}</h1>
        </div>
    </div>

    <div class="exercise-content-grid">
        
        <div class="exercise-main-card">
            <div class="exercise-card-header">
                <h2 class="exercise-name">{{ $exercise['name'] }}</h2>
                <div class="exercise-meta-info">
                    <div class="meta-info-item">
                        <i class="bi bi-calendar-plus"></i>
                        <span>Créé le {{ $exercise['created_at'] ?? 'N/A' }}</span>
                    </div>
                    <div class="meta-info-item">
                        <i class="bi bi-clock-history"></i>
                        <span>Modifié le {{ $exercise['updated_at'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="exercise-card-body">
                <div class="info-section">
                    <div class="section-label">
                        <i class="bi bi-text-paragraph"></i>
                        Description
                    </div>
                    <div class="section-content">
                        <div class="description-text">{{ $exercise['description'] ?? 'Aucune description disponible' }}</div>
                    </div>
                </div>

                <div class="info-section">
                    <div class="section-label">
                        <i class="bi bi-info-circle"></i>
                        Instructions
                    </div>
                    <div class="section-content">
                        {{ $exercise['instructions'] ?? 'Aucune instruction disponible' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="exercise-info-sidebar">
            <div class="info-card">
                <h3 class="info-card-title">Informations</h3>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-item-label">
                            <i class="bi bi-tag"></i>
                            Statut
                        </span>
                        <span class="status-badge active">
                            <i class="bi bi-check-circle-fill"></i> Actif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">
                            <i class="bi bi-diagram-3"></i>
                            Catégorie
                        </span>
                        <span class="info-item-value">{{ $exercise['category'] ?? 'Non définie' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">
                            <i class="bi bi-speedometer2"></i>
                            Difficulté
                        </span>
                        <span class="info-item-value">{{ $exercise['difficulty'] ?? 'Non définie' }}</span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3 class="info-card-title">Actions rapides</h3>
                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <i class="bi bi-files"></i>
                        Modifier l'exercice
                    </a>
                    <a href="#" class="action-btn">
                        <i class="bi bi-printer"></i>
                        Exporter en PDF
                    </a>
                    <a href="#" class="action-btn">
                        <i class="bi bi-share"></i>
                        Supprimer l'exercice
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection