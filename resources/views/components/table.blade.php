<div class="table-container">
    <div class="table-header">
        <div class="table-title">
            <i class="bi bi-list-ul"></i> {{ $tableTitle }}
        </div>
        <div class="table-actions">
            <button class="btn-table-action">
                <i class="bi bi-download"></i> Exporter
            </button>
            <button class="btn-table-action">
                <i class="bi bi-funnel"></i> Filtrer
            </button>
        </div>
    </div>
                
    <div class="table-responsive">
        <table class="generic-table">
            <thead>
                <tr>
                    @foreach($rows as $item)
                        <th style="width: 120px;">{{ $item }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>
                            <div class="entity-name">
                                <div class="entity-icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <div class="entity-info">
                                    <div class="entity-title">{{ $d['name'] }}</div>
                                    <div class="entity-meta">Créé le {{ $d['created_at'] ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="entity-description entity-description-truncated">
                                {{ $d['description'] }}
                            </div>
                        </td>
                        <td>
                            <div class="entity-actions">
                                <a href="{{ route($routeShow, $d['id']) }}" class="btn-action btn-view" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="" class="btn-action btn-edit" title="Modifier">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route($routeDelete, $d['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Supprimer cet élément ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
.table-container {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.table-header {
    background: var(--dark);
    color: white;
    padding: 1.25rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-table-action {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: background 0.2s ease;
    cursor: pointer;
}

.btn-table-action:hover {
    background: rgba(255, 255, 255, 0.2);
}

.table-responsive {
    overflow-x: auto;
}

.entity-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.generic-table {
    width: 100%;
    table-layout: fixed;
}

.generic-table thead th {
    background: var(--dark);
    color: white;
    padding: 1rem 1.5rem;
    font-weight: 600;
    text-align: left;
    border: none;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.entity-table tbody td {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--gray-light);
    vertical-align: middle;
}

.entity-table tbody tr:last-child td {
    border-bottom: none;
}

.entity-table tbody tr {
    transition: background 0.2s ease;
}

.entity-table tbody tr:hover {
    background: #f8fafc;
}

/* Styles spécifiques aux colonnes */

.entity-name {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
}

.entity-icon {
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.entity-info {
    display: flex;
    flex-direction: column;
}

.entity-title {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.25rem;
}

.entity-meta {
    font-size: 0.75rem;
    color: var(--gray);
}

.entity-description {
    color: var(--gray);
    line-height: 1.6;
    max-width: 350px;
}

.entity-description-truncated {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.entity-actions {
    display: flex;
    gap: 0.5rem;
    padding: 0.75rem;
    justify-content: flex-start;
}
</style>