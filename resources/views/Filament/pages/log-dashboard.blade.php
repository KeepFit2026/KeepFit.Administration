<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<x-filament-panels::page>

<div class="bg-gray-50 min-h-screen -m-6 p-6 font-sans">
<div class="max-w-[1280px] mx-auto flex flex-col gap-5">

    {{-- ── HEADER ── --}}
    <div class="bg-white border border-gray-200 rounded-2xl px-6 py-5">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-black text-gray-900 tracking-tight">Journal d'activité</h1>
                    <p class="text-xs text-gray-400 mt-0.5 font-mono">{{ now()->format('d M Y · H:i') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                {{-- Search --}}
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher…"
                        class="pl-8 pr-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl w-44 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-gray-700 placeholder-gray-400" />
                </div>
                {{-- Event filter --}}
                <select wire:model.live="filterEvent"
                    class="text-sm bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">Tous</option>
                    <option value="created">Créations</option>
                    <option value="updated">Modifications</option>
                    <option value="deleted">Suppressions</option>
                </select>
                {{-- Period --}}
                <div class="flex bg-gray-100 rounded-xl p-1 gap-0.5">
                    @foreach(['7' => '7j', '14' => '14j', '30' => '30j', '90' => '90j'] as $val => $label)
                        <button wire:click="$set('period', '{{ $val }}')"
                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all {{ $period === $val ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-400 hover:text-gray-600' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ── KPI CARDS ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
        @php
            $kpis = [
                ['label' => 'Total logs',     'value' => $totalLogs,    'sub' => $period.' jours',                                          'iconBg' => 'bg-gray-100',    'iconColor' => 'text-gray-500',    'icon' => 'M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z'],
                ['label' => 'Créations',      'value' => $totalCreated, 'sub' => ($totalLogs > 0 ? round($totalCreated/$totalLogs*100) : 0).'%', 'iconBg' => 'bg-emerald-100', 'iconColor' => 'text-emerald-600', 'icon' => 'M12 4.5v15m7.5-7.5h-15'],
                ['label' => 'Modifications',  'value' => $totalUpdated, 'sub' => ($totalLogs > 0 ? round($totalUpdated/$totalLogs*100) : 0).'%', 'iconBg' => 'bg-amber-100',   'iconColor' => 'text-amber-500',   'icon' => 'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z'],
                ['label' => 'Suppressions',   'value' => $totalDeleted, 'sub' => ($totalLogs > 0 ? round($totalDeleted/$totalLogs*100) : 0).'%', 'iconBg' => 'bg-red-100',     'iconColor' => 'text-red-500',     'icon' => 'M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0'],
                ['label' => 'Utilisateurs',   'value' => $uniqueUsers,  'sub' => 'actifs distincts',                                        'iconBg' => 'bg-violet-100',  'iconColor' => 'text-violet-600',  'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z'],
            ];
        @endphp
        @foreach($kpis as $kpi)
            <div class="bg-white border border-gray-200 rounded-2xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">{{ $kpi['label'] }}</span>
                    <div class="w-[30px] h-[30px] rounded-[9px] {{ $kpi['iconBg'] }} flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 {{ $kpi['iconColor'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $kpi['icon'] }}"/></svg>
                    </div>
                </div>
                <div class="text-[28px] font-black text-gray-900 tracking-tight leading-none">{{ number_format($kpi['value']) }}</div>
                <div class="text-xs text-gray-400 mt-1.5">{{ $kpi['sub'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- ── CHARTS ROW ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Line chart --}}
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <div class="text-sm font-bold text-gray-900">Activité quotidienne</div>
                    <div class="text-xs text-gray-400 mt-0.5">Actions sur {{ $period }} jours</div>
                </div>
                <span class="text-[11px] font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-lg">{{ $totalLogs }} total</span>
            </div>
            <canvas id="activityChart" height="130"></canvas>
        </div>

        {{-- Donut --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <div class="mb-5">
                <div class="text-sm font-bold text-gray-900">Répartition</div>
                <div class="text-xs text-gray-400 mt-0.5">Par type d'événement</div>
            </div>
            <div class="flex items-center gap-5">
                <div class="flex-shrink-0 w-[110px] h-[110px]">
                    <canvas id="donutChart"></canvas>
                </div>
                <div class="flex-1 flex flex-col gap-2.5">
                    @foreach([['Créations', $totalCreated, 'bg-emerald-500'], ['Modifs', $totalUpdated, 'bg-amber-400'], ['Suppres.', $totalDeleted, 'bg-red-400']] as [$lbl, $v, $dot])
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $dot }} flex-shrink-0"></span>
                            <span class="text-xs text-gray-500 flex-1">{{ $lbl }}</span>
                            <span class="text-xs font-black text-gray-800">{{ $v }}</span>
                            <span class="text-[10px] text-gray-300 w-7 text-right">{{ $totalLogs > 0 ? round($v/$totalLogs*100) : 0 }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ── BOTTOM ROW ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Top users --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <div class="text-sm font-bold text-gray-900">Top utilisateurs</div>
                    <div class="text-xs text-gray-400 mt-0.5">{{ $period }} derniers jours</div>
                </div>
            </div>
            @php $maxUser = $topUsers->max('count') ?: 1; @endphp
            <div class="flex flex-col gap-3">
                @forelse($topUsers as $i => $user)
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-300 w-3 font-mono font-bold">{{ $i+1 }}</span>
                        <div class="w-8 h-8 rounded-[10px] bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center text-xs font-black flex-shrink-0">
                            {{ strtoupper(substr($user['email'], 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-semibold text-gray-700 truncate">{{ $user['email'] }}</div>
                            <div class="mt-1.5 h-1 bg-gray-100 rounded-full">
                                <div class="h-full bg-emerald-400 rounded-full" style="width:{{ round($user['count']/$maxUser*100) }}%"></div>
                            </div>
                        </div>
                        <span class="text-xs font-black text-emerald-500 flex-shrink-0">{{ $user['count'] }}</span>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-6">Aucune donnée</p>
                @endforelse
            </div>
        </div>

        {{-- Top models --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5">
            <div class="mb-4">
                <div class="text-sm font-bold text-gray-900">Modèles touchés</div>
                <div class="text-xs text-gray-400 mt-0.5">Fréquence des opérations</div>
            </div>
            @php $mc = ['#10b981','#3b82f6','#f59e0b','#8b5cf6','#ef4444','#06b6d4']; $maxModel = $topModels->max('count') ?: 1; @endphp
            <div class="flex flex-col gap-3">
                @forelse($topModels as $i => $model)
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full flex-shrink-0" style="background:{{ $mc[$i%count($mc)] }}"></div>
                        <span class="text-xs font-semibold text-gray-700 w-20 flex-shrink-0 truncate">{{ $model['model'] }}</span>
                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full" style="width:{{ round($model['count']/$maxModel*100) }}%; background:{{ $mc[$i%count($mc)] }}"></div>
                        </div>
                        <span class="text-xs font-black text-gray-500 w-5 text-right font-mono">{{ $model['count'] }}</span>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-6">Aucune donnée</p>
                @endforelse
            </div>
        </div>

        {{-- Heatmap --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <div class="text-sm font-bold text-gray-900">Par heure</div>
                    <div class="text-xs text-gray-400 mt-0.5">Distribution 00h–23h</div>
                </div>
            </div>
            @php $maxHour = max($hourlyData) ?: 1; @endphp
            <div class="grid grid-cols-8 gap-1.5 mb-3">
                @foreach($hourlyData as $h => $count)
                    @php $op = $count > 0 ? max(0.1, $count/$maxHour) : 0.04; @endphp
                    <div title="{{ sprintf('%02d',$h) }}h · {{ $count }} action(s)"
                         class="aspect-square rounded-lg flex items-end justify-center pb-0.5 hover:scale-110 transition-transform cursor-default"
                         style="background:rgba(16,185,129,{{ $op }})">
                        <span class="text-[7px] font-mono font-bold" style="color:rgba(5,80,40,0.5)">{{ sprintf('%02d',$h) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[10px] text-gray-300">Faible</span>
                <div class="flex gap-1 items-center">
                    @foreach([0.06, 0.2, 0.4, 0.7, 1.0] as $o)
                        <div class="w-4 h-2 rounded-sm" style="background:rgba(16,185,129,{{ $o }})"></div>
                    @endforeach
                </div>
                <span class="text-[10px] text-gray-300">Élevé</span>
            </div>
        </div>
    </div>

    {{-- ── LOG TABLE ── --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <div class="text-sm font-bold text-gray-900">Toutes les activités</div>
                <div class="text-xs text-gray-400 mt-0.5">Détail des opérations enregistrées</div>
            </div>
            <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">{{ $recentLogs->total() }} entrées</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Événement</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Modèle</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Description</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Détails</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLogs as $log)
                        @php
                            [$ebg, $edot] = match($log->event) {
                                'created' => ['bg-emerald-100 text-emerald-700', 'bg-emerald-500'],
                                'updated' => ['bg-amber-100 text-amber-700',     'bg-amber-400'],
                                'deleted' => ['bg-red-100 text-red-600',         'bg-red-400'],
                                default   => ['bg-gray-100 text-gray-500',       'bg-gray-300'],
                            };
                            $elabel = match($log->event) {
                                'created' => 'Créé', 'updated' => 'Modifié', 'deleted' => 'Supprimé',
                                default => ucfirst($log->event ?? '—')
                            };
                        @endphp
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors last:border-0">
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold {{ $ebg }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $edot }}"></span>
                                    {{ $elabel }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                @if($log->causer)
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-[8px] bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center text-[11px] font-black flex-shrink-0">
                                            {{ strtoupper(substr($log->causer->email ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="text-xs text-gray-600 truncate max-w-[130px]">{{ $log->causer->email }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-300 italic">Système</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                @if($log->subject_type)
                                    <span class="px-2 py-0.5 bg-violet-100 text-violet-700 text-[11px] font-bold rounded-lg">{{ class_basename($log->subject_type) }}</span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-xs text-gray-500 font-mono">{{ $log->description }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                @if($log->properties && $log->properties->count())
                                    <div x-data="{ open: false }" class="relative inline-block">
                                        <button x-on:click="open = !open"
                                            class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-gray-500 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 px-2.5 py-1 rounded-lg transition-colors">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            Voir
                                        </button>
                                        <div x-show="open" x-transition x-on:click.outside="open = false"
                                             class="absolute z-50 bottom-full left-0 mb-2 w-72 bg-gray-900 rounded-xl p-3 shadow-2xl border border-gray-800">
                                            <pre class="text-[11px] text-emerald-400 font-mono whitespace-pre-wrap break-all max-h-48 overflow-y-auto leading-relaxed">{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-200 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="text-xs text-gray-600">{{ $log->created_at->diffForHumans() }}</div>
                                <div class="text-[10px] text-gray-400 font-mono mt-0.5">{{ $log->created_at->format('d/m H:i') }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <svg class="w-10 h-10 mx-auto text-gray-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                <p class="text-sm text-gray-400">Aucune activité sur cette période</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($recentLogs->hasPages())
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50">
                {{ $recentLogs->links() }}
            </div>
        @endif
    </div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = 'rgba(0,0,0,0.04)';
    const tick = '#9ca3af';

    // Line chart
    new Chart(document.getElementById('activityChart'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                data: @json($chartData),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,0.05)',
                borderWidth: 2,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#10b981',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: { label: ctx => ` ${ctx.raw} action(s)` },
                    backgroundColor: '#111827',
                    titleColor: '#9ca3af',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 10,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: tick, font: { size: 10 } } },
                y: { beginAtZero: true, grid: { color: grid }, ticks: { color: tick, font: { size: 10 }, precision: 0 } }
            }
        }
    });

    // Donut
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $totalCreated }}, {{ $totalUpdated }}, {{ $totalDeleted }}],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 5,
            }]
        },
        options: {
            responsive: true,
            cutout: '74%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: { label: ctx => ` ${ctx.raw} (${Math.round(ctx.raw / {{ max($totalLogs,1) }} * 100)}%)` },
                    backgroundColor: '#111827',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 10,
                }
            }
        }
    });
});
</script>

</x-filament-panels::page>