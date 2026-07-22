<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Mes Trajets</title>
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

        .main { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
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
        .role-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #4ade80;
            font-weight: 500;
            font-size: 13px;
            background: rgba(34, 197, 94, 0.1);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        .content-body { padding: 30px; }

        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 25px; }

        .table-container {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; background: #0f172a; border-bottom: 1px solid #1e293b; }
        td { padding: 10px 14px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }

        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-termine { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .badge-encours { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
        .badge-planifie { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }

        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-box {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon { width: 46px; height: 46px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .stat-icon.green { background: rgba(34, 197, 94, 0.15); }
        .stat-icon.amber { background: rgba(251, 191, 36, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('chauffeur.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Espace Chauffeur</a></li>
            <li class="active"><a href="{{ route('chauffeur.trajets') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Mes Trajets</a></li>
            <li><a href="{{ route('chauffeur.vehicule') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Mon Véhicule</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                Mes Trajets
            </div>
            <div class="role-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#4ade80;display:inline-block;"></span>
                Connecté — Chauffeur
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                Historique de Mes Trajets
            </h1>
            <div class="subtitle">Consultez l'ensemble de vos trajets enregistrés sur la Blockchain.</div>

            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Trajets ce Mois</div>
                        <div class="stat-value">12</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Terminés</div>
                        <div class="stat-value">10</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">En Cours</div>
                        <div class="stat-value">2</div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Départ</th>
                            <th>Destination</th>
                            <th>Kilométrage</th>
                            <th>Statut</th>
                            <th>Hash Blockchain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15/06/2026</td>
                            <td>Douala</td>
                            <td>Yaoundé</td>
                            <td>45 200 km</td>
                            <td><span class="badge badge-termine">Terminé</span></td>
                            <td style="font-family:monospace;font-size:11px;color:#22d3ee;">0xd9145...F39138</td>
                        </tr>
                        <tr>
                            <td>14/06/2026</td>
                            <td>Yaoundé</td>
                            <td>Bafoussam</td>
                            <td>45 100 km</td>
                            <td><span class="badge badge-termine">Terminé</span></td>
                            <td style="font-family:monospace;font-size:11px;color:#22d3ee;">0x766d9...E52D38</td>
                        </tr>
                        <tr>
                            <td>13/06/2026</td>
                            <td>Douala</td>
                            <td>Limbé</td>
                            <td>44 950 km</td>
                            <td><span class="badge badge-encours">En cours</span></td>
                            <td style="font-family:monospace;font-size:11px;color:#22d3ee;">0x508d9...d9145C</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

