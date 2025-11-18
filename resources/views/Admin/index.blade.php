@extends('Layouts.admin')

@section('title', 'Dashboard')

{{-- //TODO: Model de base, à redéfinir. --}}
@section('')
<div class="dashboard">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Utilisateurs Actifs</h3>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-value">1,248</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12% ce mois
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-header">
                <h3 class="stat-title">Séances Complétées</h3>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">3,567</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8% cette semaine
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-header">
                <h3 class="stat-title">Programmes Actifs</h3>
                <div class="stat-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
            </div>
            <div class="stat-value">156</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 5% aujourd'hui
            </div>
        </div>

        <div class="stat-card danger">
            <div class="stat-header">
                <h3 class="stat-title">Taux d'Abandon</h3>
                <div class="stat-icon">
                    <i class="fas fa-running"></i>
                </div>
            </div>
            <div class="stat-value">4.2%</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 2% ce mois
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="dashboard-grid">
        <!-- Chart Section -->
        <div class="chart-section">
            <div class="section-header">
                <h2 class="section-title">Activité des Utilisateurs</h2>
                <div class="section-actions">
                    <a href="#">Voir le rapport complet</a>
                </div>
            </div>
            <div class="chart-placeholder">
                <i class="fas fa-chart-line" style="font-size: 3rem; margin-right: 1rem;"></i>
                Graphique d'activité des utilisateurs
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <div class="section-header">
                <h2 class="section-title">Activité Récente</h2>
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
                    <div class="activity-icon" style="background-color: var(--secondary);">
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
            <h2 class="section-title">Actions Rapides</h2>
        </div>
        <div class="actions-grid">
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-text">Nouvel Exercice</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="action-text">Créer Programme</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="action-text">Envoyer Notification</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="action-text">Rapport Mensuel</div>
            </a>
        </div>
    </div>
</div>
@endsection 