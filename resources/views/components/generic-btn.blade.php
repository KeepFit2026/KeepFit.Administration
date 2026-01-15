@php
    $isSubmit = $method === 'POST';
    $cssClass = $variant->value === 'btn-create' ? 'btn-add' : 'btn-back';
    $icon = $variant->value === 'btn-create' ? 'bi-plus-lg' : ($isSubmit ? 'bi-check-lg' : 'bi-arrow-left');
@endphp

@if($isSubmit)
    <button type="submit" class="{{ $cssClass }}">
        <i class="bi {{ $icon }}"></i> {{ $name }}
    </button>
@else
    <a href="{{ $url }}" class="{{ $cssClass }}">
        <i class="bi {{ $icon }}"></i> {{ $name }}
    </a>
@endif

<style>
    .btn-add, .btn-back {
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-add {
        background: var(--secondary);
        color: white;
    }

    .btn-back {
        background: var(--primary);
        color: white;
    }

    .btn-add:hover, .btn-back:hover {
        filter: brightness(90%);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        color: white;
    }
</style>