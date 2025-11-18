@extends('Layouts.CRUD.index')

@section('title', 'Les exercices')

@section("header-title", "Gestion des Exercices")
@section('header')
    <x-create-button 
        route='admin.exercises.create' 
        name='Nouvel exercice'
    />
@endsection

@section('statistiques')
    <x-card-information 
        name="Total des exercices" 
        :data="count($exercises)"
        subname="Exercices créés"
    />

    <x-card-information 
        name="Exercices Terminés" 
        :data="0"
        class="success"
        subname="Exercices terminées"
    />
@endsection

@section("content")
    @if(!empty($errorMessage))
        <x-alert-message :errorMessage="$errorMessage" />
    @else    
        @if(empty($exercises))
            <div class="empty-state">
                <i class="bi bi-journal-x"></i>
                <h3>Aucun exercice trouvé</h3>
                <p>Commencez par créer votre premier exercice</p>
            </div>
        @else
            <x-table
                tableTitle="Liste des exercices"
                :rows="['Name', 'Description', 'Actions']"
                :data="$exercises"
            />
        @endif
    @endif
@endsection