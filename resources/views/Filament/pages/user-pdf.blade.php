<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Fiche élève — {{ $user->name ?? 'Utilisateur' }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1a1a1a;
            background: #ffffff;
            width: 750px;
        }

        /* ── HEADER ── */
        .header-bar {
            background: #111827;
            padding: 12px 24px;
            width: 750px;
        }
        .header-brand {
            float: left;
            color: #10b981;
            font-size: 15px;
            font-weight: 900;
        }
        .header-doc {
            float: right;
            color: #6b7280;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 3px;
        }
        .clearfix::after { content:''; display:table; clear:both; }

        .accent-line {
            height: 3px;
            background: #10b981;
            width: 750px;
        }

        .identity-bar {
            padding: 14px 24px;
            border-bottom: 1px solid #e5e7eb;
            width: 750px;
        }
        .id-left  { float: left; width: 420px; }
        .id-right { float: right; text-align: right; }

        .student-name {
            font-size: 16px;
            font-weight: 900;
            color: #111827;
        }
        .student-sub {
            font-size: 9px;
            color: #6b7280;
            margin-top: 3px;
        }
        .role-tag {
            display: inline-block;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 1px 7px;
            border: 1px solid #10b981;
            color: #059669;
            margin-top: 5px;
        }
        .role-tag-admin   { border-color: #dc2626; color: #dc2626; }
        .role-tag-teacher { border-color: #d97706; color: #d97706; }

        .meta-lbl {
            font-size: 7px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .meta-val {
            font-size: 10px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        /* ── CONTENU ── */
        .body { padding: 18px 24px; width: 750px; }

        .section-title {
            font-size: 7px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #9ca3af;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
            margin-bottom: 10px;
            margin-top: 16px;
            width: 702px;
        }
        .section-title:first-child { margin-top: 0; }

        /* ── STATS ── */
        .stats-table { width: 702px; border-collapse: separate; border-spacing: 6px 0; }
        .stat-cell {
            width: 170px;
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            vertical-align: top;
        }
        .s-label {
            font-size: 7px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }
        .s-value {
            font-size: 20px;
            font-weight: 900;
            color: #111827;
            letter-spacing: -0.5px;
            line-height: 1;
        }
        .s-trend {
            display: inline-block;
            font-size: 7px;
            font-weight: 700;
            padding: 1px 5px;
            margin-top: 3px;
        }
        .trend-up   { background: #d1fae5; color: #059669; }
        .trend-down { background: #fee2e2; color: #dc2626; }
        .s-sub { font-size: 8px; color: #9ca3af; margin-top: 2px; }

        /* ── XP BAR ── */
        .xp-wrap { width: 702px; }
        .xp-labels { width: 702px; margin-bottom: 18px; }
        .xp-lbl-l { float: left;  font-size: 9px; font-weight: 700; color: #374151; }
        .xp-lbl-r { float: right; font-size: 9px; font-weight: 600; color: #9ca3af; }
        .level-pill {
            float: right;
            font-size: 8px;
            font-weight: 800;
            color: #059669;
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            padding: 1px 8px;
        }
        .xp-track {
            width: 702px;
            height: 8px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }
        .xp-fill { height: 8px; background: #10b981; }
        .xp-note { font-size: 8px; color: #9ca3af; margin-top: 4px; }

        /* ── DEUX COLONNES ── */
        .two-col { width: 702px; }
        .col-main { float: left; width: 430px; }
        .col-side { float: right; width: 256px; }

        /* ── BARRES ACTIVITÉ ── */
        .activity-title {
            font-size: 7px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 14px;
            margin-bottom: 4px;
        }
        .act-table { width: 430px; border-collapse: collapse; }
        .act-table td { text-align: center; vertical-align: bottom; padding: 0 3px; width: 61px; }
        .act-bar { width: 100%; border: 1px solid; }
        .act-day { font-size: 7px; margin-top: 2px; }

        /* ── MUSCLES ── */
        .muscle-title {
            font-size: 7px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }
        .muscle-table { width: 256px; border-collapse: collapse; }
        .muscle-table td { padding: 4px 0; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .muscle-table tr:last-child td { border-bottom: none; }
        .m-name { font-size: 9px; font-weight: 600; color: #374151; width: 60px; }
        .m-track { width: 160px; height: 5px; background: #f3f4f6; border: 1px solid #e5e7eb; }
        .m-fill  { height: 5px; }
        .m-pct   { font-size: 8px; font-weight: 700; color: #374151; width: 28px; text-align: right; padding-left: 6px; }

        /* ── EXERCICES ── */
        .ex-table { width: 702px; border-collapse: collapse; }
        .ex-table thead td {
            font-size: 7px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 0 0 5px 0;
            border-bottom: 2px solid #111827;
        }
        .ex-table tbody td {
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 10px;
            color: #374151;
            vertical-align: middle;
        }
        .ex-table tbody tr:last-child td { border-bottom: none; }
        .ex-name { font-weight: 700; color: #111827; }
        .diff-tag {
            font-size: 7px;
            font-weight: 700;
            padding: 1px 6px;
            border: 1px solid;
        }
        .diff-hard   { border-color: #fca5a5; color: #dc2626; }
        .diff-medium { border-color: #fcd34d; color: #d97706; }
        .diff-easy   { border-color: #6ee7b7; color: #059669; }
        .xp-col { font-weight: 800; color: #059669; text-align: right; }

        /* ── FOOTER ── */
        .footer {
            border-top: 1px solid #e5e7eb;
            padding: 8px 24px;
            width: 750px;
            margin-top: 16px;
        }
        .f-left  { float: left;  font-size: 8px; color: #9ca3af; }
        .f-right { float: right; font-size: 8px; color: #9ca3af; }
        .f-brand { font-weight: 800; color: #10b981; }
        .bottom-line { height: 3px; background: #10b981; width: 750px; margin-top: 6px; }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header-bar clearfix">
        <div class="header-brand">Keepfit</div>
        <div class="header-doc">Fiche Élève — Confidentiel</div>
    </div>
    <div class="accent-line"></div>

    <div class="identity-bar clearfix">
        <div class="id-left">
            <div class="student-name">{{ $user->name ?? 'Utilisateur' }}</div>
            <div class="student-sub">
                {{ $record->email ?? '—' }}
                &nbsp;·&nbsp;
                Classe : {{ $user->classroom->name ?? 'Non assigné' }}
                &nbsp;·&nbsp;
                Inscrit le {{ $record->created_at?->format('d/m/Y') ?? '—' }}
            </div>
            @if($record->roles->isNotEmpty())
                @foreach($record->roles as $role)
                    @php $rc = match(strtolower($role->name)) { 'admin' => 'role-tag role-tag-admin', 'teacher' => 'role-tag role-tag-teacher', default => 'role-tag' }; @endphp
                    <span class="{{ $rc }}">{{ $role->name }}</span>
                @endforeach
            @endif
        </div>
        <div class="id-right">
            <div class="meta-lbl">Document généré le</div>
            <div class="meta-val">{{ now()->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="body">

        {{-- INDICATEURS --}}
        <div class="section-title">Indicateurs de performance</div>
        <table class="stats-table">
            <tr>
                @foreach([
                    ['label'=>'XP Total',  'value'=>'2 450', 'trend'=>'↑ +5.2%', 'up'=>true,  'sub'=>'+120 cette semaine'],
                    ['label'=>'Séances',   'value'=>'47',    'trend'=>'↑ +3',    'up'=>true,  'sub'=>'Dernière il y a 2j'],
                    ['label'=>'Exercices', 'value'=>'312',   'trend'=>'↑ +18',   'up'=>true,  'sub'=>'Complétés au total'],
                    ['label'=>'Streak',    'value'=>'12j',   'trend'=>'↓ -2j',   'up'=>false, 'sub'=>'Record : 21 jours'],
                ] as $s)
                    <td class="stat-cell">
                        <div class="s-label">{{ $s['label'] }}</div>
                        <div class="s-value">{{ $s['value'] }}</div>
                        <div><span class="s-trend {{ $s['up'] ? 'trend-up' : 'trend-down' }}">{{ $s['trend'] }}</span></div>
                        <div class="s-sub">{{ $s['sub'] }}</div>
                    </td>
                @endforeach
            </tr>
        </table>

        {{-- PROGRESSION & ACTIVITÉ --}}
        <div class="section-title">Progression & Activité</div>
        <div class="xp-wrap">
            <div class="xp-labels clearfix">
                <span class="xp-lbl-l">2 450 XP &nbsp;/&nbsp; 3 000 XP</span>
                <span class="level-pill">Niveau 8</span>
                <span class="xp-lbl-r">81%</span>
            </div>
            <div class="xp-track"><div class="xp-fill" style="width:81%;"></div></div>
            <div class="xp-note">550 XP avant le niveau 9</div>
        </div>

        <table style="width:702px; border-collapse:collapse; margin-top:12px;">
            <tr style="vertical-align:top;">
                <td style="width:430px; padding-right:16px;">
                    <div class="activity-title">Activité — 7 derniers jours</div>
                    <table style="width:414px; border-collapse:collapse; height:56px;">
                        <tr>
                            @foreach([
                                ['h'=>22,'day'=>'L','t'=>false],
                                ['h'=>38,'day'=>'M','t'=>false],
                                ['h'=>16,'day'=>'M','t'=>false],
                                ['h'=>50,'day'=>'J','t'=>false],
                                ['h'=>30,'day'=>'V','t'=>false],
                                ['h'=>44,'day'=>'S','t'=>false],
                                ['h'=>56,'day'=>'D','t'=>true],
                            ] as $b)
                                <td style="text-align:center; vertical-align:bottom; padding:0 3px; width:59px;">
                                    <div style="width:100%; height:{{ $b['h'] }}px; background:{{ $b['t'] ? '#10b981' : '#d1fae5' }}; border:1px solid {{ $b['t'] ? '#059669' : '#a7f3d0' }};"></div>
                                    <div style="font-size:7px; color:{{ $b['t'] ? '#059669' : '#9ca3af' }}; font-weight:{{ $b['t'] ? '700' : '400' }}; margin-top:2px;">{{ $b['day'] }}</div>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </td>
                <td style="width:256px; vertical-align:top;">
                    <div class="muscle-title">Répartition musculaire</div>
                    <table style="width:256px; border-collapse:collapse;">
                        @foreach([
                            ['name'=>'Jambes',   'pct'=>28, 'w'=>100, 'color'=>'#10b981'],
                            ['name'=>'Poitrine', 'pct'=>22, 'w'=>79,  'color'=>'#3b82f6'],
                            ['name'=>'Dos',      'pct'=>20, 'w'=>71,  'color'=>'#8b5cf6'],
                            ['name'=>'Abdos',    'pct'=>17, 'w'=>61,  'color'=>'#f97316'],
                            ['name'=>'Bras',     'pct'=>13, 'w'=>46,  'color'=>'#f59e0b'],
                        ] as $m)
                            <tr>
                                <td style="font-size:9px; font-weight:600; color:#374151; width:55px; padding:4px 0; border-bottom:1px solid #f3f4f6;">{{ $m['name'] }}</td>
                                <td style="padding:4px 6px; border-bottom:1px solid #f3f4f6;">
                                    <div style="width:140px; height:5px; background:#f3f4f6; border:1px solid #e5e7eb;">
                                        <div style="width:{{ $m['w'] }}px; height:5px; background:{{ $m['color'] }};"></div>
                                    </div>
                                </td>
                                <td style="font-size:8px; font-weight:700; color:#374151; text-align:right; width:28px; padding:4px 0; border-bottom:1px solid #f3f4f6;">{{ $m['pct'] }}%</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>

        {{-- EXERCICES --}}
        <div class="section-title">Derniers exercices réalisés</div>
        <table class="ex-table">
            <thead>
                <tr>
                    <td style="width:38%;">Exercice</td>
                    <td style="width:18%;">Groupe</td>
                    <td style="width:14%;">Séries</td>
                    <td style="width:14%;">Durée</td>
                    <td style="width:10%;">Niveau</td>
                    <td style="width:6%; text-align:right;">XP</td>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['name'=>'Squat',            'group'=>'Jambes',   'sets'=>'4×8',   'mins'=>'35 min', 'diff'=>'Difficile', 'cls'=>'diff-hard',   'xp'=>30],
                    ['name'=>'Développé couché', 'group'=>'Poitrine', 'sets'=>'3×10',  'mins'=>'28 min', 'diff'=>'Moyen',     'cls'=>'diff-medium', 'xp'=>25],
                    ['name'=>'Tractions',        'group'=>'Dos',      'sets'=>'4×6',   'mins'=>'22 min', 'diff'=>'Difficile', 'cls'=>'diff-hard',   'xp'=>35],
                    ['name'=>'Gainage',          'group'=>'Abdos',    'sets'=>'3×60s', 'mins'=>'15 min', 'diff'=>'Facile',    'cls'=>'diff-easy',   'xp'=>15],
                    ['name'=>'Curl biceps',      'group'=>'Bras',     'sets'=>'3×12',  'mins'=>'18 min', 'diff'=>'Moyen',     'cls'=>'diff-medium', 'xp'=>20],
                ] as $ex)
                    <tr>
                        <td class="ex-name">{{ $ex['name'] }}</td>
                        <td style="color:#6b7280;">{{ $ex['group'] }}</td>
                        <td>{{ $ex['sets'] }}</td>
                        <td style="color:#6b7280;">{{ $ex['mins'] }}</td>
                        <td><span class="diff-tag {{ $ex['cls'] }}">{{ $ex['diff'] }}</span></td>
                        <td class="xp-col">+{{ $ex['xp'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- FOOTER --}}
    <div class="footer clearfix">
        <div class="f-left"><span class="f-brand">Keepfit</span> — Document confidentiel à usage interne</div>
        <div class="f-right">Généré le {{ now()->format('d/m/Y à H:i') }}</div>
    </div>
    <div class="bottom-line"></div>

</body>
</html>