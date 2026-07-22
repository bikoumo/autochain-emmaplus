<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Gestion des Chauffeurs</title>
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
            letter-spacing: 0.5px;
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
        .stat-icon.amber { background: rgba(251, 191, 36, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }

        .table-container {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            overflow: hidden;
        }
        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-header h3 { font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px; }
        .filter-label {
            font-size: 12px;
            color: #64748b;
            background: rgba(56, 189, 248, 0.1);
            padding: 4px 12px;
            border-radius: 12px;
            border: 1px solid rgba(56, 189, 248, 0.2);
            color: #38bdf8;
        }
        .add-btn {
            background: #38bdf8;
            color: #0b1120;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .add-btn:hover { background: #7dd3fc; }

        table { width: 100%; border-collapse: collapse; }
        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #0f172a;
            border-bottom: 1px solid #1e293b;
        }
        td { padding: 14px 16px; font-size: 14px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge.disponible { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .badge.inactif { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .badge.mission { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 32px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: modalIn 0.25s ease;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .modal-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-close {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: rgba(248, 113, 113, 0.15);
            color: #f87171;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .modal-close:hover { background: rgba(248, 113, 113, 0.25); }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px 14px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #f1f5f9;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .form-group input:focus, .form-group select:focus { border-color: #38bdf8; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
            justify-content: flex-end;
        }
        .btn-cancel {
            padding: 10px 20px;
            background: transparent;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #94a3b8;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-cancel:hover { background: #1e293b; color: #fff; }
        .btn-submit {
            padding: 10px 24px;
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.25);
        }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        .form-error {
            color: #f87171;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }
        .form-error.visible { display: block; }
        .form-group.has-error input,
        .form-group.has-error select { border-color: #f87171; }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
            z-index: 2000;
            display: none;
            animation: slideIn 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .toast.success { background: rgba(34, 197, 94, 0.95); color: #fff; border: 1px solid rgba(34,197,94,0.3); }
        .toast.error { background: rgba(248, 113, 113, 0.95); color: #fff; border: 1px solid rgba(248,113,113,0.3); }
        .toast.visible { display: flex; align-items: center; gap: 8px; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
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
            <li class="active"><a href="{{ route('admin.chauffeurs') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>Chauffeurs</a></li>
            <li><a href="{{ route('admin.garages') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Garages</a></li>
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
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Super Admin — Chauffeurs
            </div>
            <div class="network-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>
                Réseau: Ethereum Mainnet
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Gestion des Chauffeurs
            </h1>
            <div class="subtitle">Cliquez sur une carte pour filtrer la liste. Utilisez "+ Ajouter" pour inscrire un nouveau chauffeur.</div>

            <div class="stats-row" id="statsRow">
                <a href="{{ route('admin.chauffeurs', ['filter' => 'all']) }}" class="stat-box {{ ($filter ?? 'all') === 'all' ? 'active-filter' : '' }}">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Chauffeurs</div>
                        <div class="stat-value" id="statTotal">{{ $total ?? 24 }}</div>
                    </div>
                </a>
                <a href="{{ route('admin.chauffeurs', ['filter' => 'mission']) }}" class="stat-box {{ ($filter ?? 'all') === 'mission' ? 'active-filter' : '' }}">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">En Mission</div>
                        <div class="stat-value" id="statMission">{{ $enMission ?? 18 }}</div>
                    </div>
                </a>
                <a href="{{ route('admin.chauffeurs', ['filter' => 'inactive']) }}" class="stat-box {{ ($filter ?? 'all') === 'inactive' ? 'active-filter' : '' }}">
                    <div class="stat-icon amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Inactifs / Repos</div>
                        <div class="stat-value" id="statInactive">{{ $inactifs ?? 6 }}</div>
                    </div>
                </a>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        Liste des Chauffeurs
                        @if(($filter ?? 'all') === 'mission')
                            <span class="filter-label">● Filtré : En Mission</span>
                        @elseif(($filter ?? 'all') === 'inactive')
                            <span class="filter-label">● Filtré : Inactifs</span>
                        @else
                            <span class="filter-label">● Tous les chauffeurs</span>
                        @endif
                    </h3>
                    <button class="add-btn" onclick="openModal()">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Ajouter
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Chauffeur</th>
                            <th>Email</th>
                            <th>Véhicule Attitré</th>
                            <th>Statut</th>
                            <th>Dernière Mission</th>
                        </tr>
                    </thead>
                    <tbody id="chauffeursTableBody">
                        @forelse($chauffeurs ?? [] as $c)
                        <tr data-statut="{{ $c->statut }}">
                            <td style="display:flex;align-items:center;gap:10px;">
                                @php
                                    $initials = strtoupper(substr($c->nom, 0, 1)) . strtoupper(substr(explode(' ', $c->nom)[1] ?? $c->nom, 0, 1));
                                    $colors = ['#38bdf8', '#22d3ee', '#a78bfa', '#4ade80', '#fbbf24', '#f87171'];
                                    $colorIdx = crc32($c->id) % count($colors);
                                @endphp
                                <span style="width:32px;height:32px;border-radius:50%;background:{{ $colors[$colorIdx] }};color:#0b1120;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;">{{ $initials }}</span>
                                {{ $c->nom }}
                            </td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->vehicule_attitre ?? '—' }}</td>
                            <td>
                                @if($c->statut === 'mission')
                                    <span class="badge mission">En Mission</span>
                                @elseif($c->statut === 'disponible')
                                    <span class="badge disponible">Disponible</span>
                                @else
                                    <span class="badge inactif">Inactif</span>
                                @endif
                            </td>
                            <td>{{ $c->derniere_mission ? $c->derniere_mission->format('d/m/Y') : '—' }}</td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="5" style="text-align:center;padding:30px;color:#64748b;">Aucun chauffeur trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===== MODALE AJOUT CHAUFFEUR ===== -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <div class="modal-header">
                <h2>
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Ajouter un Chauffeur
                </h2>
                <button class="modal-close" onclick="closeModal()">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <form id="chauffeurForm" onsubmit="return submitChauffeur(event)">
                @csrf
                <div class="form-group" id="fg-nom">
                    <label>Nom complet</label>
                    <input type="text" name="nom" id="input-nom" required placeholder="Ex: Jean Dupont">
                    <div class="form-error" id="error-nom">Ce champ est requis</div>
                </div>
                <div class="form-group" id="fg-email">
                    <label>Email</label>
                    <input type="email" name="email" id="input-email" required placeholder="Ex: jean.dupont@autochain.com">
                    <div class="form-error" id="error-email">Email invalide ou déjà utilisé</div>
                </div>
                <div class="form-row">
                    <div class="form-group" id="fg-statut">
                        <label>Statut</label>
                        <select name="statut" id="input-statut" required>
                            <option value="disponible">Disponible</option>
                            <option value="mission">En Mission</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>
                    <div class="form-group" id="fg-telephone">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" id="input-telephone" placeholder="Ex: 06 12 34 56 78">
                    </div>
                </div>
                <div class="form-group" id="fg-vehicule">
                    <label>Véhicule attitré (optionnel)</label>
                    <input type="text" name="vehicule_attitre" id="input-vehicule" placeholder="Ex: Toyota RAV4 (VIN: 1HGCR...)">
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/></svg>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== TOAST ===== -->
    <div class="toast" id="toast"></div>

    <script>
        function openModal() {
            document.getElementById('modalOverlay').classList.add('active');
            document.getElementById('chauffeurForm').reset();
            document.querySelectorAll('.form-error').forEach(e => e.classList.remove('visible'));
            document.querySelectorAll('.form-group').forEach(e => e.classList.remove('has-error'));
        }
        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('active');
        }
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            toast.className = 'toast ' + type + ' visible';
            toast.innerHTML = (type === 'success'
                ? '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> '
                : '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> ')
                + message;
            setTimeout(() => { toast.classList.remove('visible'); }, 4000);
        }

        async function submitChauffeur(event) {
            event.preventDefault();
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke-dasharray="30 70" opacity="0.3"/><circle cx="12" cy="12" r="10" stroke-dasharray="30 70"/></svg> Enregistrement...';

            document.querySelectorAll('.form-error').forEach(e => e.classList.remove('visible'));
            document.querySelectorAll('.form-group').forEach(e => e.classList.remove('has-error'));

            const form = document.getElementById('chauffeurForm');
            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("admin.chauffeurs.store") }}', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            const fg = document.getElementById('fg-' + field);
                            const err = document.getElementById('error-' + field);
                            if (fg) fg.classList.add('has-error');
                            if (err) { err.textContent = messages[0]; err.classList.add('visible'); }
                        }
                    }
                    throw new Error(data.message || 'Erreur lors de l\'enregistrement');
                }

                // Succès : ajouter la ligne au tableau
                const c = data.chauffeur;
                const colors = ['#38bdf8', '#22d3ee', '#a78bfa', '#4ade80', '#fbbf24', '#f87171'];
                const colorIdx = c.id % colors.length;
                const nameParts = c.nom.split(' ');
                const initials = c.nom.charAt(0).toUpperCase() + (nameParts[1] ? nameParts[1].charAt(0).toUpperCase() : c.nom.charAt(1).toUpperCase());

                const badgeClass = c.statut === 'mission' ? 'mission' : (c.statut === 'disponible' ? 'disponible' : 'inactif');
                const badgeLabel = c.statut === 'mission' ? 'En Mission' : (c.statut === 'disponible' ? 'Disponible' : 'Inactif');
                const derniere = c.derniere_mission ? new Date(c.derniere_mission).toLocaleDateString('fr-FR') : '—';

                const emptyRow = document.getElementById('emptyRow');
                if (emptyRow) emptyRow.remove();

                const tbody = document.getElementById('chauffeursTableBody');
                const tr = document.createElement('tr');
                tr.setAttribute('data-statut', c.statut);
                tr.innerHTML = `
                    <td style="display:flex;align-items:center;gap:10px;">
                        <span style="width:32px;height:32px;border-radius:50%;background:${colors[colorIdx]};color:#0b1120;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;">${initials}</span>
                        ${c.nom}
                    </td>
                    <td>${c.email}</td>
                    <td>${c.vehicule_attitre || '—'}</td>
                    <td><span class="badge ${badgeClass}">${badgeLabel}</span></td>
                    <td>${derniere}</td>
                `;
                tbody.appendChild(tr);

                // Mettre à jour les stats
                document.getElementById('statTotal').textContent = data.stats.total;
                document.getElementById('statMission').textContent = data.stats.mission;
                document.getElementById('statInactive').textContent = data.stats.inactive;

                closeModal();
                showToast('Chauffeur ' + c.nom + ' ajouté avec succès !');

            } catch (err) {
                showToast(err.message || 'Erreur réseau', 'error');
            }

            btn.disabled = false;
            btn.innerHTML = '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/></svg> Enregistrer';
            return false;
        }
    </script>
</body>
</html>
