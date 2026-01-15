{{-- On étend ton layout principal --}}
@extends('Layouts.admin')

@section('title', 'Service indisponible')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/css/error-page.css') }}">
@endsection

@section('content')
    <div class="error-content-wrapper">
        <div class="error-card">
            
            <div class="icon-pulsing">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.89 6.89A11.05 11.05 0 0112 6.75a11.03 11.03 0 017.78 3.22M6.11 9.67a6.97 6.97 0 014.22-1.42m6.34 0a6.97 6.97 0 011.66.2M9.41 12.97a2.98 2.98 0 012.59-1.22m3.65 0c.34.09.67.23.97.4" />
                </svg>
            </div>

            <h1>Petite pause technique</h1>
            
            <p>
                La connexion avec les données semble interrompue. 
                Le reste de l'interface est accessible, mais cette section nécessite l'API pour fonctionner.
            </p>

            <div class="error-actions">
                <button onclick="window.location.reload()" class="btn-soft btn-soft-primary">
                    <i class="bi bi-arrow-clockwise me-2"></i> Réessayer
                </button>
            </div>

        </div>
    </div>
@endsection