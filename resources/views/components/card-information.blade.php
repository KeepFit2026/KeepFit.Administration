<div class="stat-card {{ $class }}">
    <div class="stat-header">
        <div class="stat-title">{{ $name }}</div>
        <div class="stat-icon">
            <i class="bi bi-journal-text"></i>
        </div>
    </div>
    <div class="stat-value">{{ $data }}</div>
    <div class="stat-description"> {{ $subname }}</div>
</div>

<style>
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary);
        transition: box-shadow 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .stat-card.success {
        border-left-color: var(--secondary);
    }

    .stat-card.warning {
        border-left-color: var(--warning);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-title {
        font-size: 0.875rem;
        color: var(--gray);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        color: white;
        font-size: 1.1rem;
    }

    .stat-card.success .stat-icon-exercise {
        background: var(--secondary);
    }

    .stat-card.warning .stat-icon-exercise {
        background: var(--warning);
    }
</style>