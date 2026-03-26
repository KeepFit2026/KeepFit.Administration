<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class LogDashboard extends Page
{
    protected static ?string $navigationLabel = 'Logs & Activité';
    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.log-dashboard';

    public string $period = '7'; // jours
    public string $search = '';
    public string $filterEvent = '';

    protected function getViewData(): array
    {
        $days = (int) $this->period;
        $from = Carbon::now()->subDays($days);

        $query = Activity::with('causer')
            ->where('created_at', '>=', $from);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('description', 'ilike', "%{$this->search}%")
                  ->orWhere('subject_type', 'ilike', "%{$this->search}%")
                  ->orWhereHas('causer', fn($q) => $q->where('email', 'ilike', "%{$this->search}%"));
            });
        }

        if ($this->filterEvent) {
            $query->where('event', $this->filterEvent);
        }

        $activities = $query->latest()->get();

        // Stats globales
        $totalLogs     = $activities->count();
        $totalCreated  = $activities->where('event', 'created')->count();
        $totalUpdated  = $activities->where('event', 'updated')->count();
        $totalDeleted  = $activities->where('event', 'deleted')->count();
        $uniqueUsers   = $activities->whereNotNull('causer_id')->pluck('causer_id')->unique()->count();

        // Logs par jour pour le graphique
        $logsPerDay = Activity::where('created_at', '>=', $from)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartData   = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($date)->format('d/m');
            $chartData[]   = $logsPerDay[$date]->count ?? 0;
        }

        // Top utilisateurs
        $topUsers = Activity::where('created_at', '>=', $from)
            ->whereNotNull('causer_id')
            ->selectRaw('causer_id, COUNT(*) as count')
            ->groupBy('causer_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $user = \App\Models\Login::find($item->causer_id);
                return [
                    'email' => $user?->email ?? 'Inconnu',
                    'count' => $item->count,
                ];
            });

        // Top modèles touchés
        $topModels = Activity::where('created_at', '>=', $from)
            ->whereNotNull('subject_type')
            ->selectRaw('subject_type, COUNT(*) as count')
            ->groupBy('subject_type')
            ->orderByDesc('count')
            ->limit(6)
            ->get()
            ->map(fn($item) => [
                'model' => class_basename($item->subject_type),
                'count' => $item->count,
            ]);

        // Répartition par event
        $eventStats = Activity::where('created_at', '>=', $from)
            ->selectRaw('event, COUNT(*) as count')
            ->groupBy('event')
            ->get()
            ->keyBy('event');

        // Activité par heure (heatmap)
        $hourlyStats = Activity::where('created_at', '>=', $from)
            ->selectRaw('EXTRACT(HOUR FROM created_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->keyBy('hour');

        $hourlyData = [];
        for ($h = 0; $h < 24; $h++) {
            $hourlyData[] = $hourlyStats[$h]->count ?? 0;
        }

        // Logs récents paginés
        $recentLogs = $query->latest()->paginate(15);

        return [
            'totalLogs'    => $totalLogs,
            'totalCreated' => $totalCreated,
            'totalUpdated' => $totalUpdated,
            'totalDeleted' => $totalDeleted,
            'uniqueUsers'  => $uniqueUsers,
            'chartLabels'  => $chartLabels,
            'chartData'    => $chartData,
            'topUsers'     => $topUsers,
            'topModels'    => $topModels,
            'eventStats'   => $eventStats,
            'hourlyData'   => $hourlyData,
            'recentLogs'   => $recentLogs,
            'activities'   => $activities,
        ];
    }

    public function updatedPeriod(): void
    {
        // Livewire re-render automatiquement
    }

    public function updatedSearch(): void {}
    public function updatedFilterEvent(): void {}
}