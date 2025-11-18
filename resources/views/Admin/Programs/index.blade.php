@extends('Layouts.CRUD.index')

@section('title', 'Les programmes')

@section('header-title', 'Gestion des programmes')
@section('header')
    <x-create-button 
        route='admin.programs.create' 
        name='Nouveau programme'
    />
@endsection

@section('statistiques')
    <x-card-information
        name="Total des programmes"
        :data="count($programs)"
        subname="Exercices créés"
    />

    <x-card-information
        name="Programmes terminés"
        :data="0"
        subname="Programmes terminées"
        class="success"
    />
@endsection


@section('content')
    @if(!empty($errorMessage))
        <x-alert-message :errorMessage="$errorMessage" />
    @else
        @if(empty($programs))
            <div class="empty-state">
                <i class="bi bi-journal-x"></i>
                <h3>Aucun Programme trouvé</h3>
                <p>Commencez par créer votre premier programme</p>
            </div>
        @else
            <x-table
                tableTitle="Liste des programmes"
                :rows="['Name', 'Description', 'Actions']"
                :data="$programs"
            />
        @endif
    @endif
@endsection