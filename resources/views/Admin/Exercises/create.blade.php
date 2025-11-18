@extends('Layouts.admin')

@section('title', 'Créer un exercice')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/exercises/create.css') }}">
@endsection

@section('content')
<div class="container-fluid exercises-section">
    
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                <x-page-nav :items="[
                    ['route' => 'admin.exercises.index', 'label' => 'Gestion des exercices', 'icon' => 'bi bi-house-door'],
                    ['label' => 'Créer un exercice']
                ]" />
            </div>
            <h1 class="page-title">Créer un nouvel exercice</h1>
        </div>
    </div>

    <div class="exercise-form-container">
        <div class="exercise-form-card">
            <div class="form-card-header">
                <div class="form-badge">
                    <i class="bi bi-plus-circle"></i>
                    Nouvel exercice
                </div>
                <h2 class="form-title">Informations de l'exercice</h2>
            </div>
            
            <form action="{{ route('admin.exercises.store') }}" method="POST" class="exercise-form">
                @csrf
                
                <div class="form-body">
                    <div class="form-section">
                        <div class="section-label">
                            <i class="bi bi-card-heading"></i>
                            Informations de base
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Nom de l'exercice <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="Ex: Développé couché, Squat, Pompes..." 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-label">
                            <i class="bi bi-text-paragraph"></i>
                            Description <span class="required">*</span>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">
                                Description détaillée de l'exercice
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      class="form-control textarea-control @error('description') is-invalid @enderror" 
                                      rows="6" 
                                      placeholder="Décrivez l'exercice en détail, les muscles sollicités, le mouvement à effectuer..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.exercises.index') }}" class="btn btn-cancel">
                            <i class="bi bi-arrow-left"></i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-lg"></i>
                            Créer l'exercice
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="form-sidebar">
            <div class="info-card">
                <h3 class="info-card-title">
                    <i class="bi bi-info-circle"></i>
                    Champs requis
                </h3>
                <div class="requirements-list">
                    <div class="requirement-item">
                        <div class="requirement-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="requirement-content">
                            <strong>Nom de l'exercice</strong>
                            <span>Obligatoire</span>
                        </div>
                    </div>
                    <div class="requirement-item">
                        <div class="requirement-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="requirement-content">
                            <strong>Description</strong>
                            <span>Obligatoire</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection