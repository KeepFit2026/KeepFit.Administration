@php
    $link = Route::has($route) ? route($route) : $route;
@endphp

@if($variant->value == 'btn-create')
    <a href="{{ $link }}" class="btn-add">
        <i class="bi bi-plus-lg"></i> {{ $name }}
    </a>
@endif

@if($variant->value == 'btn-back')
    <a href="{{ $link  }}" class="btn-back">
        <i class="bi-arrow-left"></i> {{ $name }}
    </a>
@endif


<style>
    .btn-add {
        background: var(--secondary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .btn-add:hover {
        filter: brightness(90%);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .btn-back {
        background: var(--primary); 
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .btn-back:hover {
        filter: brightness(90%);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        color: white;
    }
</style>
