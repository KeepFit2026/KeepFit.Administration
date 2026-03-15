<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

{{-- Force light mode indépendamment de Filament --}}
<div class="light" style="color-scheme:light;">
<div class="bg-gray-50 min-h-screen font-sans">

    {{-- HEADER --}}
    <div class="bg-white border-b border-gray-200 px-8 py-6">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between gap-6">

            <div class="flex items-center gap-5">
                {{-- Avatar --}}
                <div class="relative flex-shrink-0">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-emerald-500/20">
                        {{ strtoupper(substr($record->name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-emerald-400 border-2 border-white rounded-full block"></span>
                </div>

                {{-- Identité --}}
                <div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h1 class="text-[22px] font-black text-gray-900 m-0 tracking-tight">
                            {{ $record->name ?? 'Utilisateur' }}
                        </h1>
                        @if($record->login && $record->login->roles->isNotEmpty())
                            @foreach($record->login->roles as $role)
                                @php
                                    $pill = match(strtolower($role->name)) {
                                        'admin'   => 'bg-red-100 text-red-600',
                                        'teacher' => 'bg-amber-100 text-amber-600',
                                        default   => 'bg-emerald-100 text-emerald-600',
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wide {{ $pill }}">
                                    {{ $role->profile->name }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mt-1 flex-wrap">
                        <span class="text-sm text-gray-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            {{ $record->email ?? 'Email non renseigné' }}
                        </span>
                        @if($record->classroom)
                            <span class="text-gray-200">·</span>
                            <span class="text-sm text-gray-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-1.342"/></svg>
                                {{ $record->classroom->name }}
                            </span>
                        @endif
                        <span class="text-gray-200">·</span>
                        <span class="text-sm text-gray-400">Inscrit {{ $record->created_at?->diffForHumans() ?? 'récemment' }}</span>
                    </div>
                </div>
            </div>

            @foreach($this->getCachedHeaderActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </div>

    <div class="max-w-[1200px] mx-auto px-8 py-8 flex flex-col gap-6">

        {{-- STATS --}}
        <div class="grid grid-cols-4 gap-4">
            @php
                $stats = [
                    ['label' => 'XP Total',  'value' => '2 450', 'sub' => '+120 cette semaine', 'trend' => '+5.2%', 'up' => true,  'iconBg' => 'bg-emerald-100', 'iconColor' => 'text-emerald-600', 'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>'],
                    ['label' => 'Séances',   'value' => '47',    'sub' => 'Dernière il y a 2j',  'trend' => '+3',    'up' => true,  'iconBg' => 'bg-orange-100',  'iconColor' => 'text-orange-500',  'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/>'],
                    ['label' => 'Exercices', 'value' => '312',   'sub' => 'Complétés',            'trend' => '+18',   'up' => true,  'iconBg' => 'bg-blue-100',    'iconColor' => 'text-blue-600',    'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0"/>'],
                    ['label' => 'Streak',    'value' => '12 j',  'sub' => 'Record : 21 jours',   'trend' => '-2j',   'up' => false, 'iconBg' => 'bg-violet-100',  'iconColor' => 'text-violet-600',  'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3.5">
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</span>
                        <div class="w-[34px] h-[34px] rounded-[10px] {{ $stat['iconBg'] }} flex items-center justify-center">
                            <svg class="w-4 h-4 {{ $stat['iconColor'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $stat['svg'] !!}</svg>
                        </div>
                    </div>
                    <div class="text-[28px] font-black text-gray-900 tracking-tight">{{ $stat['value'] }}</div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-gray-400">{{ $stat['sub'] }}</span>
                        <span class="text-[11px] font-semibold px-1.5 py-0.5 rounded-md {{ $stat['up'] ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-500' }}">
                            {{ $stat['up'] ? '↑' : '↓' }} {{ $stat['trend'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- GRAPHS ROW --}}
        <div class="grid grid-cols-2 gap-6">

            {{-- XP Line Chart --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <div class="text-sm font-bold text-gray-900">Évolution XP</div>
                        <div class="text-xs text-gray-400 mt-0.5">30 derniers jours</div>
                    </div>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-lg">+420 XP</span>
                </div>
                <canvas id="xpChart" height="140"></canvas>
            </div>

            {{-- Muscle Doughnut --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="mb-5">
                    <div class="text-sm font-bold text-gray-900">Groupes musculaires</div>
                    <div class="text-xs text-gray-400 mt-0.5">Répartition des exercices</div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex-shrink-0 w-[140px] h-[140px]">
                        <canvas id="muscleChart"></canvas>
                    </div>
                    <div class="flex-1 flex flex-col gap-2">
                        @php
                            $muscles = [
                                ['label' => 'Jambes',   'pct' => 28, 'dot' => 'bg-emerald-500'],
                                ['label' => 'Poitrine', 'pct' => 22, 'dot' => 'bg-blue-500'],
                                ['label' => 'Dos',      'pct' => 20, 'dot' => 'bg-violet-500'],
                                ['label' => 'Abdos',    'pct' => 17, 'dot' => 'bg-orange-500'],
                                ['label' => 'Bras',     'pct' => 13, 'dot' => 'bg-amber-400'],
                            ];
                        @endphp
                        @foreach($muscles as $m)
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $m['dot'] }} flex-shrink-0"></span>
                                <span class="text-xs text-gray-500 flex-1">{{ $m['label'] }}</span>
                                <span class="text-xs font-bold text-gray-700">{{ $m['pct'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- PROGRESSION + INFOS --}}
        <div class="grid grid-cols-3 gap-6">

            {{-- Progression --}}
            <div class="col-span-2 bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="text-sm font-bold text-gray-900">Progression</div>
                        <div class="text-xs text-gray-400 mt-0.5">550 XP avant le niveau 9</div>
                    </div>
                    <span class="text-sm font-bold text-emerald-600 bg-emerald-100 px-3 py-1 rounded-lg">Niveau 8</span>
                </div>

                {{-- Barre XP --}}
                <div class="mb-7">
                    <div class="flex justify-between text-xs text-gray-400 mb-2">
                        <span>2 450 XP</span>
                        <span>3 000 XP</span>
                    </div>
                    <div class="h-2.5 bg-gray-100 rounded-full overflow-visible relative">
                        <div class="h-full w-[81%] bg-gradient-to-r from-emerald-500 to-emerald-400 rounded-full relative">
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-3.5 h-3.5 bg-white border-2 border-emerald-500 rounded-full shadow-sm shadow-emerald-200"></div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-2.5">
                        @foreach(['Niv.1','Niv.3','Niv.5','Niv.7','Niv.9'] as $niv)
                            <span class="text-[10px] text-gray-300">{{ $niv }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Bar chart séances --}}
                <div>
                    <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-3">Séances — 7 derniers jours</div>
                    <div class="flex items-end gap-1.5 h-[72px]">
                        @foreach([
                            ['h' => 40,  'xp' => 80,  'today' => false],
                            ['h' => 70,  'xp' => 140, 'today' => false],
                            ['h' => 30,  'xp' => 60,  'today' => false],
                            ['h' => 90,  'xp' => 180, 'today' => false],
                            ['h' => 55,  'xp' => 110, 'today' => false],
                            ['h' => 80,  'xp' => 160, 'today' => false],
                            ['h' => 100, 'xp' => 130, 'today' => true],
                        ] as $bar)
                            <div class="flex-1 flex flex-col justify-end h-full">
                                <div
                                    class="w-full rounded-t {{ $bar['today'] ? 'bg-emerald-500' : 'bg-emerald-100' }} hover:opacity-80 transition-opacity cursor-default"
                                    style="height:{{ $bar['h'] }}%"
                                    title="{{ $bar['xp'] }} XP"
                                ></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex gap-1.5 mt-2">
                        @foreach([['d'=>'L','t'=>false],['d'=>'M','t'=>false],['d'=>'M','t'=>false],['d'=>'J','t'=>false],['d'=>'V','t'=>false],['d'=>'S','t'=>false],['d'=>'D','t'=>true]] as $d)
                            <div class="flex-1 text-center text-[10px] {{ $d['t'] ? 'text-emerald-500 font-bold' : 'text-gray-400' }}">{{ $d['d'] }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Infos + badges --}}
            <div class="flex flex-col gap-4">

                {{-- Infos --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex-1">
                    <div class="text-sm font-bold text-gray-900 mb-4">Informations</div>
                    @php
                        $infos = [
                            ['label' => 'Email',  'value' => $record->email ?? '—'],
                            ['label' => 'Pseudo', 'value' => $record->profile->name ?? '—'],
                            ['label' => 'Classe', 'value' => $record->classroom->name ?? 'Non assigné'],
                            ['label' => 'ID',     'value' => substr($record->getKey(), 0, 12) . '…'],
                        ];
                    @endphp
                    @foreach($infos as $info)
                        <div class="py-2.5 border-b border-gray-50 last:border-0">
                            <div class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">{{ $info['label'] }}</div>
                            <div class="text-sm font-semibold text-gray-800 mt-0.5 truncate">{{ $info['value'] }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Badges --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    <div class="text-sm font-bold text-gray-900 mb-3.5">Badges</div>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach([
                            ['emoji' => '🔥', 'label' => 'Streak',   'earned' => true],
                            ['emoji' => '⚡', 'label' => '100 XP',   'earned' => true],
                            ['emoji' => '🏆', 'label' => 'Top 10',   'earned' => true],
                            ['emoji' => '💪', 'label' => '50 séan',  'earned' => false],
                            ['emoji' => '🌟', 'label' => 'Niv. 10',  'earned' => false],
                            ['emoji' => '🎯', 'label' => 'Parfait',  'earned' => false],
                            ['emoji' => '📈', 'label' => 'Progress', 'earned' => true],
                            ['emoji' => '🥇', 'label' => 'Podium',   'earned' => false],
                        ] as $badge)
                            <div class="flex flex-col items-center gap-1 p-2 rounded-xl bg-gray-50 {{ $badge['earned'] ? 'opacity-100' : 'opacity-30' }}" title="{{ $badge['label'] }}">
                                <span class="text-xl leading-none">{{ $badge['emoji'] }}</span>
                                <span class="text-[9px] text-gray-400 font-semibold text-center leading-tight">{{ $badge['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- EXERCICES --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <div class="text-sm font-bold text-gray-900">Derniers exercices</div>
                    <div class="text-xs text-gray-400 mt-0.5">Données statiques — à connecter</div>
                </div>
                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">312 total</span>
            </div>

            @php
                $exercises = [
                    ['name' => 'Squat',            'group' => 'Jambes',   'xp' => 30, 'diff' => 'Difficile', 'diffCls' => 'bg-red-100 text-red-600',     'sets' => '4×8',   'mins' => '35 min'],
                    ['name' => 'Développé couché', 'group' => 'Poitrine', 'xp' => 25, 'diff' => 'Moyen',     'diffCls' => 'bg-amber-100 text-amber-600',  'sets' => '3×10',  'mins' => '28 min'],
                    ['name' => 'Tractions',        'group' => 'Dos',      'xp' => 35, 'diff' => 'Difficile', 'diffCls' => 'bg-red-100 text-red-600',     'sets' => '4×6',   'mins' => '22 min'],
                    ['name' => 'Gainage',          'group' => 'Abdos',    'xp' => 15, 'diff' => 'Facile',    'diffCls' => 'bg-emerald-100 text-emerald-600','sets' => '3×60s','mins' => '15 min'],
                    ['name' => 'Curl biceps',      'group' => 'Bras',     'xp' => 20, 'diff' => 'Moyen',     'diffCls' => 'bg-amber-100 text-amber-600',  'sets' => '3×12',  'mins' => '18 min'],
                ];
            @endphp

            @foreach($exercises as $ex)
                <div class="flex items-center gap-4 px-6 py-3.5 border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors">
                    <div class="w-9 h-9 rounded-[10px] bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div>
                            <span class="text-sm font-bold text-gray-800">{{ $ex['name'] }}</span>
                            <span class="text-xs text-gray-400 ml-2">{{ $ex['group'] }}</span>
                        </div>
                        <div class="flex gap-3 mt-0.5">
                            <span class="text-[11px] text-gray-400">{{ $ex['sets'] }}</span>
                            <span class="text-[11px] text-gray-200">·</span>
                            <span class="text-[11px] text-gray-400">{{ $ex['mins'] }}</span>
                        </div>
                    </div>
                    <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full {{ $ex['diffCls'] }}">{{ $ex['diff'] }}</span>
                    <span class="text-sm font-black text-emerald-600 w-[60px] text-right">+{{ $ex['xp'] }} XP</span>
                </div>
            @endforeach
        </div>

    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const xpCtx = document.getElementById('xpChart');
    if (xpCtx) {
        new Chart(xpCtx, {
            type: 'line',
            data: {
                labels: Array.from({length: 30}, (_, i) => i % 5 === 0 ? `J${i+1}` : ''),
                datasets: [{
                    data: [80,95,85,110,130,120,140,135,150,160,145,170,165,180,175,190,185,200,195,210,205,220,215,230,225,240,235,250,245,260],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.06)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#10b981',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: ctx => `${ctx.raw} XP` },
                        backgroundColor: '#1f2937',
                        titleColor: '#9ca3af',
                        bodyColor: '#ffffff',
                        padding: 8,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#9ca3af', font: { size: 10 } } },
                    y: { grid: { color: '#f3f4f6' }, ticks: { color: '#9ca3af', font: { size: 10 }, callback: v => v + ' XP' } }
                }
            }
        });
    }

    const muscleCtx = document.getElementById('muscleChart');
    if (muscleCtx) {
        new Chart(muscleCtx, {
            type: 'doughnut',
            data: {
                labels: ['Jambes', 'Poitrine', 'Dos', 'Abdos', 'Bras'],
                datasets: [{
                    data: [28, 22, 20, 17, 13],
                    backgroundColor: ['#10b981','#3b82f6','#8b5cf6','#f97316','#f59e0b'],
                    borderWidth: 0,
                    hoverOffset: 4,
                }]
            },
            options: {
                responsive: true,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: ctx => `${ctx.label}: ${ctx.raw}%` },
                        backgroundColor: '#1f2937',
                        bodyColor: '#ffffff',
                        padding: 8,
                        cornerRadius: 8,
                    }
                }
            }
        });
    }
});
</script>