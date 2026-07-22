<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Garages Partenaires</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, sans-serif; background-color: #0b1120; color: #f1f5f9; display: flex; height: 100vh; overflow: hidden; }

        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #0f172a 0%, #0b1120 100%);
            border-right: 1px solid #1e293b;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 24px 20px;
            font-size: 18px;
            font-weight: 700;
            color: #38bdf8;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-brand svg { flex-shrink: 0; }
        .sidebar-menu { list-style: none; padding: 12px 0; flex: 1; }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .sidebar-menu li a:hover {
            background: rgba(56, 189, 248, 0.08);
            color: #e2e8f0;
            border-left-color: #38bdf8;
        }
        .sidebar-menu li.active a {
            background: rgba(56, 189, 248, 0.12);
            color: #38bdf8;
            border-left-color: #38bdf8;
        }
        .sidebar-menu li a svg { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #1e293b;
        }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }
        .sidebar-footer a:hover { color: #ef4444; }

        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .header {
            padding: 16px 30px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #1e293b;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .header-title { font-size: 15px; font-weight: 600; color: #f1f5f9; display: flex; align-items: center; gap: 8px; }
        .network-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #22d3ee;
            font-weight: 500;
            font-size: 13px;
            background: rgba(34, 211, 238, 0.1);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(34, 211, 238, 0.2);
        }
        .content-body { padding: 30px; }

        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 25px; }

        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-box {
            text-decoration: none;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .stat-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.15);
            border-color: #38bdf8;
        }
        .stat-box.active-filter {
            border-color: #38bdf8;
            background: rgba(56, 189, 248, 0.08);
        }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .stat-icon.green { background: rgba(34, 197, 94, 0.15); }
        .stat-icon.purple { background: rgba(167, 139, 250, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }

        .filter-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding: 12px 18px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 10px;
        }
        .filter-info .filter-badge {
            font-size: 13px;
            color: #38bdf8;
            font-weight: 500;
        }
        .filter-info .filter-reset {
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
            margin-left: auto;
            transition: color 0.2s;
        }
        .filter-info .filter-reset:hover { color: #f87171; }

        .garage-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .garage-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .garage-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .garage-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }
        .garage-avatar {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .garage-avatar.one { background: rgba(56, 189, 248, 0.15); }
        .garage-avatar.two { background: rgba(167, 139, 250, 0.15); }
        .garage-avatar.three { background: rgba(34, 197, 94, 0.15); }
        .garage-avatar.four { background: rgba(251, 191, 36, 0.15); }
        .garage-avatar.five { background: rgba(248, 113, 113, 0.15); }
        .garage-avatar.six { background: rgba(56, 189, 248, 0.15); }
        .garage-avatar.seven { background: rgba(167, 139, 250, 0.15); }
        .garage-avatar.eight { background: rgba(34, 197, 94, 0.15); }
        .garage-avatar.nine { background: rgba(251, 191, 36, 0.15); }
        .garage-avatar.ten { background: rgba(248, 113, 113, 0.15); }
        .garage-avatar.eleven { background: rgba(56, 189, 248, 0.15); }
        .garage-avatar.twelve { background: rgba(167, 139, 250, 0.15); }
        .garage-avatar svg { width: 24px; height: 24px; }
        .garage-name { font-size: 15px; font-weight: 600; color: #fff; }
        .garage-addr { font-size: 12px; color: #64748b; margin-top: 2px; font-family: monospace; }
        .garage-info { display: flex; gap: 16px; margin-bottom: 12px; }
        .garage-info-item { font-size: 13px; color: #94a3b8; display: flex; align-items: center; gap: 6px; }
        .garage-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        .garage-badge.active { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .garage-badge.inactive { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .garage-badge.certified { background: rgba(167, 139, 250, 0.15); color: #a78bfa; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Tableau de Bord</a></li>
            <li><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/><path d="M10 9.5v-2a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.chauffeurs') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>Chauffeurs</a></li>
            <li class="active"><a href="{{ route('admin.garages') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Garages</a></li>
            <li><a href="{{ route('admin.contracts') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>Smart Contracts</a></li>
            <li><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('login') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
Directrice Générale — Garages
            </div>
            <div class="network-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>
                Réseau: Ethereum Mainnet
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Garages & Centres Agréés
            </h1>
            <div class="subtitle">Cliquez sur une carte statistique pour filtrer la liste des garages.</div>

            <div class="stats-row">
                <a href="{{ route('admin.garages', ['filter' => 'all']) }}" class="stat-box {{ ($filter ?? 'all') === 'all' ? 'active-filter' : '' }}">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Garages</div>
                        <div class="stat-value">12</div>
                    </div>
                </a>
                <a href="{{ route('admin.garages', ['filter' => 'active']) }}" class="stat-box {{ ($filter ?? 'all') === 'active' ? 'active-filter' : '' }}">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Actifs</div>
                        <div class="stat-value">10</div>
                    </div>
                </a>
                <a href="{{ route('admin.garages', ['filter' => 'certified']) }}" class="stat-box {{ ($filter ?? 'all') === 'certified' ? 'active-filter' : '' }}">
                    <div class="stat-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Certifiés Blockchain</div>
                        <div class="stat-value">12</div>
                    </div>
                </a>
            </div>

            @if(($filter ?? 'all') !== 'all')
            <div class="filter-info">
                <span class="filter-badge">
                    @if($filter === 'active') ● Filtre actif : Garages actifs uniquement (10)
                    @elseif($filter === 'certified') ● Filtre actif : Garages certifiés Blockchain (12)
                    @endif
                </span>
                <a href="{{ route('admin.garages', ['filter' => 'all']) }}" class="filter-reset">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    Réinitialiser le filtre
                </a>
            </div>
            @endif

            <div class="garage-grid">
                @php
                    $garages = [
                        ['name' => 'Garage Central Dubois', 'addr' => '0x7B3...aF42', 'techs' => 5, 'interventions' => 23, 'statut' => 'active', 'certified' => true, 'avatar' => 'one'],
                        ['name' => 'AutoService Lyon', 'addr' => '0x9C1...bB33', 'techs' => 3, 'interventions' => 15, 'statut' => 'active', 'certified' => true, 'avatar' => 'two'],
                        ['name' => 'Marseille Mécanique', 'addr' => '0x5E7...dD11', 'techs' => 7, 'interventions' => 31, 'statut' => 'active', 'certified' => true, 'avatar' => 'three'],
                        ['name' => 'Garage du Nord', 'addr' => '0x2A8...fF77', 'techs' => 2, 'interventions' => 8, 'statut' => 'inactive', 'certified' => false, 'avatar' => 'four'],
                        ['name' => 'Bordeaux Auto Pro', 'addr' => '0x4B9...cC88', 'techs' => 4, 'interventions' => 19, 'statut' => 'active', 'certified' => true, 'avatar' => 'five'],
                        ['name' => 'Lille Mécanique Générale', 'addr' => '0x8D2...eE99', 'techs' => 6, 'interventions' => 27, 'statut' => 'active', 'certified' => true, 'avatar' => 'six'],
                        ['name' => 'Strasbourg Auto Service', 'addr' => '0x3C6...aA11', 'techs' => 3, 'interventions' => 12, 'statut' => 'active', 'certified' => true, 'avatar' => 'seven'],
                        ['name' => 'Toulouse Garage Express', 'addr' => '0x6F1...dD22', 'techs' => 8, 'interventions' => 35, 'statut' => 'active', 'certified' => true, 'avatar' => 'eight'],
                        ['name' => 'Nantes Centre Auto', 'addr' => '0x1A4...bB55', 'techs' => 4, 'interventions' => 16, 'statut' => 'active', 'certified' => true, 'avatar' => 'nine'],
                        ['name' => 'Garage Montpellier Sud', 'addr' => '0x9E7...cC66', 'techs' => 5, 'interventions' => 22, 'statut' => 'active', 'certified' => true, 'avatar' => 'ten'],
                        ['name' => 'Rennes Automobile', 'addr' => '0x2B5...dD77', 'techs' => 2, 'interventions' => 7, 'statut' => 'inactive', 'certified' => false, 'avatar' => 'eleven'],
                        ['name' => 'Nice Côte d\'Azur Garage', 'addr' => '0x7C3...eE88', 'techs' => 6, 'interventions' => 28, 'statut' => 'active', 'certified' => true, 'avatar' => 'twelve'],
                    ];

                    $currentFilter = $filter ?? 'all';
                    $filteredGarages = array_filter($garages, function($g) use ($currentFilter) {
                        if ($currentFilter === 'all') return true;
                        if ($currentFilter === 'active') return $g['statut'] === 'active';
                        if ($currentFilter === 'certified') return $g['certified'] === true;
                        return true;
                    });
                @endphp
                @forelse($filteredGarages as $g)
                <div class="garage-card">
                    <div class="garage-card-header">
                        <div class="garage-avatar {{ $g['avatar'] }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        </div>
                        <div>
                            <div class="garage-name">{{ $g['name'] }}</div>
                            <div class="garage-addr">{{ $g['addr'] }}</div>
                        </div>
                        @if($g['certified'])
                            <span class="garage-badge certified" style="margin-left:auto;">Certifié</span>
                        @endif
                        <span class="garage-badge {{ $g['statut'] === 'active' ? 'active' : 'inactive' }}" style="margin-left:{{ $g['certified'] ? '4px' : 'auto' }};">{{ $g['statut'] === 'active' ? 'Actif' : 'Inactif' }}</span>
                    </div>
                    <div class="garage-info">
                        <span class="garage-info-item">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#64748b" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            {{ $g['techs'] }} techniciens
                        </span>
                        <span class="garage-info-item">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#64748b" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>
                            {{ $g['interventions'] }} interventions
                        </span>
                    </div>
                </div>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#64748b;">Aucun garage ne correspond à ce filtre.</div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
