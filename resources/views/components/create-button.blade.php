<a href="{{ route("$route") }}" class="btn-add">
    <i class="bi bi-plus-lg"></i> {{ $name }}
</a>

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
    }

    .btn-add:hover {
        background: var(--primary);
        color: white;
        text-decoration: none;
    }
</style>
