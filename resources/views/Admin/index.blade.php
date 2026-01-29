@extends('Layouts.admin')

@section('title', 'Tableau de bord')

@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    :root {
        --primary: #4e73df;
        --secondary: #858796;
        --success: #1cc88a;
        --info: #36b9cc;
        --warning: #f6c23e;
        --danger: #e74a3b;
        --light: #f8f9fc;
        --dark: #5a5c69;
        --card-bg: #ffffff;
        --bg-body: #f3f4f6;
        --text-main: #2e384d;
        --text-muted: #8795a1;
        --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        --radius: 12px;
    }

    .dashboard {
        padding: 1.5rem;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    /* --- Stats Cards --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        border-left: 5px solid transparent;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .stat-card.primary { border-color: var(--primary); }
    .stat-card.success { border-color: var(--success); }
    .stat-card.warning { border-color: var(--warning); }
    .stat-card.danger { border-color: var(--danger); }

    .stat-content {
        flex: 1;
    }

    .stat-title {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }

    .stat-change {
        font-size: 0.85rem;
        font-weight: 500;
    }

    .stat-change.positive { color: var(--success); }
    .stat-change.negative { color: var(--danger); }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        opacity: 0.8;
    }

    .stat-card.primary .stat-icon { background: rgba(78, 115, 223, 0.1); color: var(--primary); }
    .stat-card.success .stat-icon { background: rgba(28, 200, 138, 0.1); color: var(--success); }
    .stat-card.warning .stat-icon { background: rgba(246, 194, 62, 0.1); color: var(--warning); }
    .stat-card.danger .stat-icon { background: rgba(231, 74, 59, 0.1); color: var(--danger); }


    /* --- Dashboard Grid (Charts & Activity) --- */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 992px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    .chart-section, .recent-section, .quick-actions {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.5rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 1rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .section-actions a {
        font-size: 0.85rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .chart-placeholder {
        background-color: var(--light);
        border-radius: var(--radius);
        height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        border: 2px dashed #e3e6f0;
    }

    /* --- Activity List --- */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.25rem;
        position: relative;
    }

    .activity-item:last-child {
        margin-bottom: 0;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        margin-right: 1rem;
        flex-shrink: 0;
        z-index: 1;
    }

    .activity-content {
        flex: 1;
        padding-top: 0.25rem;
    }

    .activity-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.2rem;
    }

    .activity-time {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* --- Quick Actions --- */
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: var(--light);
        padding: 1.5rem;
        border-radius: var(--radius);
        text-decoration: none;
        color: var(--text-main);
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .action-btn:hover {
        background-color: #fff;
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .action-icon {
        font-size: 1.8rem;
        margin-bottom: 0.8rem;
        color: var(--text-muted);
        transition: color 0.2s;
    }

    .action-btn:hover .action-icon {
        color: var(--primary);
    }

    .action-text {
        font-weight: 600;
        font-size: 0.95rem;
    }
</style>
@endsection

@section('content')
<div class="dashboard">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Card 1 -->
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-title">Utilisateurs Actifs</div>
                <div class="stat-value">1,248</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12% ce mois
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-title">Séances Complétées</div>
                <div class="stat-value">3,567</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8% cette semaine
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="stat-card warning">
            <div class="stat-content">
                <div class="stat-title">Programmes Actifs</div>
                <div class="stat-value">156</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 5% aujourd'hui
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-dumbbell"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="stat-card danger">
            <div class="stat-content">
                <div class="stat-title">Taux d'Abandon</div>
                <div class="stat-value">4.2%</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 2% ce mois
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-chart-area"></i>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="dashboard-grid">
        <!-- Chart Section -->
        <div class="chart-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-chart-pie me-2"></i> Activité des Utilisateurs</h2>
                <div class="section-actions">
                    <a href="#">Voir le rapport <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="chart-placeholder">
                <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                <span>Graphique d'activité des utilisateurs</span>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-history me-2"></i> Activité Récente</h2>
                <div class="section-actions">
                    <a href="#">Tout voir</a>
                </div>
            </div>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Nouvel utilisateur inscrit</div>
                        <div class="activity-time">Il y a 5 minutes</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon" style="background-color: var(--success);">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Séance complétée</div>
                        <div class="activity-time">Il y a 15 minutes</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon" style="background-color: var(--warning);">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Programme modifié</div>
                        <div class="activity-time">Il y a 1 heure</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon" style="background-color: var(--danger);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Problème signalé</div>
                        <div class="activity-time">Il y a 2 heures</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="section-header">
            <h2 class="section-title"><i class="fas fa-bolt me-2"></i> Actions Rapides</h2>
        </div>
        <div class="actions-grid">
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-text">Nouvel Exercice</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-text">Créer Programme</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="action-text">Envoyer Notif.</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="action-text">Rapport Mensuel</div>
            </a>
        </div>
    </div>
</div>
@endsection