@extends('Layouts.admin')

@section('title', $pageTitle ?? 'Créer un élément')

@section('link')
    @if(!empty($customCss))
        @foreach($customCss as $cssFile)
            <link rel="stylesheet" href="{{ asset($cssFile) }}">
        @endforeach
    @else
        {{-- fallback si aucun CSS spécifique --}}
        <link rel="stylesheet" href="{{ asset('assets/css/exercises/create.css') }}">
    @endif
@endsection

@section('content')
<div class="container-fluid exercises-section">
    
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                <x-page-nav :items="$breadcrumb ?? []" />
            </div>
            <h1 class="page-title">{{ $headerTitle ?? 'Créer un élément' }}</h1>
        </div>
    </div>

    <div class="exercise-form-container">
        {{-- Formulaire --}}
        <div class="exercise-form-card">
            <div class="form-card-header">
                @if(!empty($formBadge))
                    <div class="form-badge">
                        <i class="{{ $formBadge['icon'] ?? 'bi bi-plus-circle' }}"></i>
                        {{ $formBadge['label'] ?? 'Nouvel élément' }}
                    </div>
                @endif
                <h2 class="form-title">{{ $formTitle ?? 'Informations' }}</h2>
            </div>
            
            <form action="{{ $formAction ?? '#' }}" method="{{ $formMethod ?? 'POST' }}" class="exercise-form">
                @csrf
                @if(!empty($formMethod) && strtoupper($formMethod) !== 'POST')
                    @method($formMethod)
                @endif
                
                <div class="form-body">
                    @foreach($fields ?? [] as $field)
                        <div class="form-section">
                            <div class="section-label">
                                <i class="{{ $field['icon'] ?? 'bi bi-card-heading' }}"></i>
                                {{ $field['label'] ?? '' }}
                                @if(!empty($field['required'])) <span class="required">*</span> @endif
                            </div>
                            <div class="form-group">
                                @if(($field['type'] ?? 'text') === 'textarea')
                                    <textarea name="{{ $field['name'] ?? '' }}"
                                              id="{{ $field['id'] ?? $field['name'] ?? '' }}"
                                              class="form-control @error($field['name']) is-invalid @enderror"
                                              rows="{{ $field['rows'] ?? 4 }}"
                                              placeholder="{{ $field['placeholder'] ?? '' }}"
                                              @if(!empty($field['required'])) required @endif>{{ old($field['name'], $field['value'] ?? '') }}</textarea>
                                @else
                                    <input type="{{ $field['type'] ?? 'text' }}"
                                           name="{{ $field['name'] ?? '' }}"
                                           id="{{ $field['id'] ?? $field['name'] ?? '' }}"
                                           class="form-control @error($field['name']) is-invalid @enderror"
                                           value="{{ old($field['name'], $field['value'] ?? '') }}"
                                           placeholder="{{ $field['placeholder'] ?? '' }}"
                                           @if(!empty($field['required'])) required @endif>
                                @endif
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    {{-- Actions --}}
                    <div class="form-actions">
                        <a href="{{ $cancelRoute ?? '#' }}" class="btn btn-cancel">
                            <i class="bi bi-arrow-left"></i>
                            {{ $cancelLabel ?? 'Annuler' }}
                        </a>
                        <button type="submit" class="btn btn-submit">
                            <i class="{{ $submitIcon ?? 'bi bi-check-lg' }}"></i>
                            {{ $submitLabel ?? 'Enregistrer' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Sidebar --}}
        @if(!empty($sidebar))
        <div class="form-sidebar">
            <div class="info-card">
                <h3 class="info-card-title">
                    <i class="bi bi-info-circle"></i>
                    {{ $sidebar['title'] ?? 'Informations' }}
                </h3>
                <div class="requirements-list">
                    @foreach($sidebar['items'] ?? [] as $item)
                        <div class="requirement-item">
                            <div class="requirement-icon">
                                <i class="{{ $item['icon'] ?? 'bi bi-check-circle-fill' }}"></i>
                            </div>
                            <div class="requirement-content">
                                <strong>{{ $item['label'] ?? '' }}</strong>
                                <span>{{ $item['description'] ?? '' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 