@extends('Layouts.admin')

@section('title', $pageTitle ?? ($entity['name'] ?? 'Détails de l\'élément'))

@section('link')
    @if(!empty($customCss))
        @foreach($customCss as $cssFile)
            <link rel="stylesheet" href="{{ asset($cssFile) }}">
        @endforeach
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/exercises/show.css') }}">
    @endif
@endsection

@section('content')
<div class="container-fluid exercises-section">
    
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-nav">
                <x-page-nav :items="$breadcrumb ?? []" />
            </div>
            <h1 class="page-title">{{ $entity['name'] ?? 'Détails de l\'élément' }}</h1>
        </div>
    </div>

    <div class="exercise-content-grid">
        
        {{-- Main Card --}}
        <div class="exercise-main-card">
            <div class="exercise-card-header">
                <h2 class="exercise-name">{{ $entity['name'] ?? 'Nom indisponible' }}</h2>
                <div class="exercise-meta-info">
                    <div class="meta-info-item">
                        <i class="bi bi-calendar-plus"></i>
                        <span>Créé le {{ $entity['created_at'] ?? 'N/A' }}</span>
                    </div>
                    <div class="meta-info-item">
                        <i class="bi bi-clock-history"></i>
                        <span>Modifié le {{ $entity['updated_at'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="exercise-card-body">
                @if(!empty($entity['description']))
                <div class="info-section">
                    <div class="section-label">
                        <i class="bi bi-text-paragraph"></i>
                        Description
                    </div>
                    <div class="section-content">
                        <div class="description-text">{{ $entity['description'] }}</div>
                    </div>
                </div>
                @endif

                @if(!empty($entity['instructions']))
                <div class="info-section">
                    <div class="section-label">
                        <i class="bi bi-info-circle"></i>
                        Instructions
                    </div>
                    <div class="section-content">
                        {{ $entity['instructions'] }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="exercise-info-sidebar">
            @if(!empty($sidebar))
                @foreach($sidebar as $card)
                    <div class="info-card">
                        <h3 class="info-card-title">{{ $card['title'] ?? 'Informations' }}</h3>
                        <div class="{{ $card['listClass'] ?? 'info-list' }}">
                            @foreach($card['items'] ?? [] as $item)
                                <div class="info-item">
                                    @if(!empty($item['label']))
                                        <span class="info-item-label">
                                            @if(!empty($item['icon']))<i class="{{ $item['icon'] }}"></i>@endif
                                            {{ $item['label'] }}
                                        </span>
                                    @endif

                                    @if(!empty($item['text']))
                                        <a href="{{ $item['value'] }}" class="action-btn">
                                            @if(!empty($item['icon']))<i class="{{ $item['icon'] }}"></i>@endif
                                            {{ $item['text'] }}
                                        </a>
                                    @else
                                        <span class="{{ $item['valueClass'] ?? 'info-item-value' }}">
                                            {!! $item['value'] ?? '' !!}
                                        </span>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</div>
@endsection