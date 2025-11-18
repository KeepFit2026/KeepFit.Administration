@extends('Layouts.admin')

@section('title', 'Créer un programme')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/program.css') }}">
@endsection

@section('content')

<div class="container-fluid programs-section">

    <!-- Icon et entete -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-plus-circle"></i> Créer un nouveau programme
        </h1>
        <a href="{{ route('admin.programs.index') }}" class="btn-add-program" style="background: #6c757d;">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <!-- Formulaire -->
    <div class="programs-table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="bi bi-file-earmark-text"></i> Informations du programme
            </div>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.programs.store') }}" method="POST">
                @csrf

                <!-- Nom -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-tag"></i> Nom du programme <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Ex: Programme Débutant"
                        required
                    >
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="bi bi-text-paragraph"></i> Description
                    </label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="4"
                        placeholder="Décrivez le programme..."
                    ></textarea>
                </div>

                <!-- Bouton creer -->
                <div class="form-actions">
                    <a href="{{ route('admin.programs.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i> Créer le programme
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
