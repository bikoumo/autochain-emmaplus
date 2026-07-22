<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Gestion du Parc</title>
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

        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }

        .parc-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
        .panel {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
        }
        .panel-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 12px;
            border-bottom: 1px solid #334155;
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 10px 12px; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #334155; background: #0f172a; }
        td { padding: 10px 12px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }

        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; color: #94a3b8; font-size: 13px; font-weight: 500; }
        input {
            width: 100%;
            padding: 10px 14px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #f1f5f9;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        input:focus { border-color: #38bdf8; }

        button.submit-btn {
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            color: #fff;
            border: none;
            padding: 11px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            margin-top: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        button.submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.25);
        }

        .alert-success, .alert-warning {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        .alert-warning {
            background: rgba(251, 191, 36, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.2);
        }

        .vin-badge {
            font-family: monospace;
            font-size: 12px;
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            padding: 2px 8px;
            border-radius: 4px;
        }
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
            <li class="active"><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/><path d="M10 9.5v-2a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.chauffeurs') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>Chauffeurs</a></li>
            <li><a href="{{ route('admin.garages') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Garages</a></li>
            <li><a href="{{ route('admin.contracts') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>Smart Contracts</a></li>
            <li><a href="{{ route('admin.demandes') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Demandes d'Accès</a></li>
            <li><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/></svg>
Directrice Générale — Gestion du Parc
            </div>
            <div class="network-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>
                Réseau: Ethereum Mainnet
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/></svg>
                Gestion du Parc Automobile
            </h1>

            @if(session('success'))
                <div class="alert-success">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Véhicule enregistré avec succès en base de données !
                </div>
            @endif

            @if(session('warning'))
                <div class="alert-warning">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    {{ session('warning') }}
                </div>
            @endif

            <div class="parc-grid">
                <!-- Colonne de gauche : Liste de la flotte -->
                <div class="panel">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                        Registre des Véhicules de la Flotte
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>VIN</th>
                                <th>Marque / Modèle</th>
                                <th>Propriétaire</th>
                                <th>Kilométrage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vehicles ?? [] as $vehicle)
                            <tr>
                                <td><span class="vin-badge">{{ $vehicle->vin }}</span></td>
                                <td>{{ $vehicle->marque }} {{ $vehicle->modele }}</td>
                                <td>{{ Str::limit($vehicle->proprietaire_adresse, 10) }}</td>
                                <td>{{ number_format($vehicle->kilometrage, 0, ',', ' ') }} km</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: #64748b; padding: 30px;">
                                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="#64748b" stroke-width="1.5" style="display:block;margin:0 auto 10px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    Aucun véhicule enregistré pour le moment.<br>Utilisez le formulaire à droite.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Colonne de droite : Formulaire d'enregistrement -->
                <div class="panel">
                    <div class="panel-title">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Ajouter un Véhicule
                    </div>
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#64748b" stroke-width="2" style="vertical-align:middle;"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/></svg>
                                Numéro VIN (17 caractères)
                            </label>
                            <input type="text" name="vin" required placeholder="Ex: 1HGCR2F83HA000000">
                        </div>
                        <div class="form-group">
                            <label>Marque</label>
                            <input type="text" name="marque" required placeholder="Ex: Toyota">
                        </div>
                        <div class="form-group">
                            <label>Modèle</label>
                            <input type="text" name="modele" required placeholder="Ex: RAV4">
                        </div>
                        <div class="form-group">
                            <label>
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#64748b" stroke-width="2" style="vertical-align:middle;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                                Adresse Propriétaire (Ethereum)
                            </label>
                            <input type="text" name="proprietaire_adresse" required placeholder="Ex: 0x5B3...edDC">
                        </div>
                        <div class="form-group">
                            <label>Kilométrage</label>
                            <input type="number" name="kilometrage" required placeholder="Ex: 45000">
                        </div>
                        <button type="submit" class="submit-btn">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                            Enregistrer le Véhicule
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

