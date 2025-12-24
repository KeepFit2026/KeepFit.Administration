<div class="table-container-wrapper">
    @if($variant->value == "default")
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
                                <th style="width: 600px;">{{ $item }}</th> 
                            @endforeach
                            <th>Actions</th>
                        </tr>
                    </thead>
              <tbody>
                @foreach($data as $d)
                    @php 
                        $itemId = data_get($d, 'id') ?? data_get($d, 'Id'); 
                    @endphp

                    <tr>
                        @foreach($rows as $key => $label)
                            <td>
                                @if($loop->first)
                                    <div class="entity-name">
                                        <div class="entity-icon">
                                            <i class="{{ $headerIcon ?? 'bi bi-activity' }}"></i>
                                        </div>
                                        <div class="entity-info">
                                            <div class="entity-title">{{ data_get($d, $key) }}</div>
                                            
                                            <div class="entity-meta">
                                                Créé le {{ data_get($d, 'created_at') ?? data_get($d, 'CreatedAt') ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="entity-description entity-description-truncated">
                                        {{ data_get($d, $key) ?? '-' }}
                                    </div>
                                @endif
                            </td>
                        @endforeach

                        <td>
                            <div class="entity-actions">
                                @if(isset($routeShow) && $routeShow)
                                    <a href="{{ route($routeShow, $itemId) }}" class="btn-action btn-view" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @endif

                                <a href="#" class="btn-action btn-edit" title="Modifier">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if(isset($routeDelete) && $routeDelete)
                                    <form action="{{ route($routeDelete, $itemId) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
                </table>
            </div>
        </div>

    @else
        <div class="cards-list-container">
            @forelse($data as $d)
                <div class="card-row-item">
                    <div class="card-row-main">
                        <div class="card-row-icon">
                            <i class="bi bi-activity"></i> 
                        </div>
                        <div class="card-row-content">
                            <div class="card-row-title">{{ $d['name'] }}</div>
                            <div class="card-row-desc">{{ $d['description'] ?? 'Pas de description.' }}</div>
                        </div>
                    </div>

                    <div class="card-row-actions">
                        <a href="{{ route($routeShow, $d['id']) }}" class="btn-solid-action btn-solid-view">
                            Voir
                        </a>

                        @if($routeDelete)
                            <form action="{{ route($routeDelete, $d['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-solid-action btn-solid-delete" onclick="return confirm('Retirer cet élément ?')">
                                    Retirer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state-card">
                    <i class="bi bi-inbox"></i>
                    <p>Aucun élément associé pour le moment.</p>
                </div>
            @endforelse
        </div>
    @endif
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

    .generic-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
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

    .generic-table tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--gray-light, #e5e7eb);
        vertical-align: middle;
    }

    .generic-table tbody tr:last-child td {
        border-bottom: none;
    }

    .generic-table tbody tr {
        transition: background 0.2s ease;
    }

    .generic-table tbody tr:hover {
        background: #f8fafc;
    }

    /* Cellules spécifiques */
    .entity-name {
        display: flex;
        align-items: center;
        gap: 0.75rem;
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
        color: var(--gray, #6b7280);
    }

    .entity-description {
        color: var(--gray, #6b7280);
        line-height: 1.6;
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
        justify-content: flex-start;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-view { background: rgba(59, 130, 246, 0.1); color: var(--primary); }
    .btn-view:hover { background: var(--primary); color: white; }
    
    .btn-edit { background: rgba(107, 114, 128, 0.1); color: var(--gray, #6b7280); }
    .btn-edit:hover { background: var(--gray, #6b7280); color: white; }
    
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: var(--danger, #ef4444); }
    .btn-delete:hover { background: var(--danger, #ef4444); color: white; }
    
    .cards-list-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .card-row-item {
        display: flex;
        align-items: center;
        justify-content: space-between; 
        padding: 1.25rem 1.5rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); 
    }

    .card-row-main {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex: 1;
        min-width: 0;
    }

    .card-row-icon {
        width: 48px;
        height: 48px;
        background: #f3f4f6;
        color: var(--dark);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
        border: 1px solid #e5e7eb;
    }

    .card-row-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        flex: 1;
        min-width: 0;
    }

    .card-row-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--dark);
    }

    .card-row-desc {
        color: var(--gray, #6b7280);
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 90%;
    }

    .card-row-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-left: 1.5rem;
        border-left: 1px solid #f3f4f6;
        margin-left: 1rem;
    }

    .btn-solid-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s;
        border: 1px solid transparent;
    }

    .btn-solid-view {
        background-color: #eff6ff;
        color: var(--primary);
        border-color: #dbeafe;
    }
    .btn-solid-view:hover {
        background-color: #dbeafe;
    }

    .btn-solid-delete {
        background-color: white;
        color: #ef4444;
        border-color: #fee2e2;
    }
    .btn-solid-delete:hover {
        background-color: #fef2f2;
        border-color: #fca5a5;
    }

    .empty-state-card {
        background: white;
        border: 1px dashed #d1d5db;
        border-radius: 0.5rem;
        padding: 2.5rem;
        text-align: center;
        color: var(--gray, #6b7280);
    }
    .empty-state-card i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
        opacity: 0.5;
    }
</style>