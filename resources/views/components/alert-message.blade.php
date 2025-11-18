<div class="alert-message warning">
    <i class="bi bi-exclamation-triangle"></i>
    <div>{{ $errorMessage }}</div>
</div>

<style>
    .alert-message {
        border-radius: 0.75rem;
        border: none;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .alert-message.info {
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary-dark);
    }

    .alert-message.warning {
        background: rgba(245, 158, 11, 0.1);
        color: #b45309;
    }

    .alert-message i {
        font-size: 1.25rem;
    }
</style>