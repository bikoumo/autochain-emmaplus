<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Mon Véhicule</title>
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

        .vehicle-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 14px;
            padding: 28px;
            max-width: 650px;
        }
        .vehicle-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #334155;
        }
        .vehicle-icon {
            width: 64px; height: 64px;
            border-radius: 14px;
            background: rgba(56, 189, 248, 0.15);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .vehicle-icon svg { width: 32px; height: 32px; }
        .vehicle-name { font-size: 20px; font-weight: 700; color: #fff; }
        .vehicle-vin { font-size: 12px; color: #64748b; font-family: monospace; margin-top: 4px; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .info-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .info-value { font-size: 15px; color: #e2e8f0; font-weight: 600; }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        .status-badge.mission { background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.2); }

        .blockchain-section {
            margin-top: 20px;
            padding: 16px 20px;
            background: rgba(34, 211, 238, 0.06);
            border: 1px solid rgba(34, 211, 238, 0.12);
            border-radius: 10px;
        }
        .blockchain-section .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 13px;
        }
        .blockchain-section .row .label { color: #64748b; }
        .blockchain-section .row .value { color: #22d3ee; font-family: monospace; font-size: 12px; }
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
            <li><a href="{{ route('chauffeur.trajets') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Mes Trajets</a></li>
            <li class="active"><a href="{{ route('chauffeur.vehicule') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Mon Véhicule</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Mon Véhicule
            </div>
            <div class="role-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#4ade80;display:inline-block;"></span>
                Connecté — Chauffeur
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Mon Véhicule Attitré
            </h1>
            <div class="subtitle">Informations détaillées de votre véhicule et son enregistrement Blockchain.</div>

            <div class="vehicle-card">
                <div class="vehicle-header">
                    <div class="vehicle-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/></svg>
                    </div>
                    <div>
                        <div class="vehicle-name">Toyota RAV4</div>
                        <div class="vehicle-vin">VIN : 1HGCR2F83HA000000</div>
                    </div>
                    <span class="status-badge mission" style="margin-left:auto;">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        En Mission
                    </span>
                </div>

                <div class="info-grid">
                    <div><div class="info-label">Marque</div><div class="info-value">Toyota</div></div>
                    <div><div class="info-label">Modèle</div><div class="info-value">RAV4</div></div>
                    <div><div class="info-label">Année</div><div class="info-value">2023</div></div>
                    <div><div class="info-label">Kilométrage</div><div class="info-value">45 200 km</div></div>
                    <div><div class="info-label">Propriétaire</div><div class="info-value" style="font-family:monospace;font-size:13px;color:#38bdf8;">0x5B3...edDC</div></div>
                    <div><div class="info-label">Dernière Révision</div><div class="info-value">12/05/2026</div></div>
                </div>

                <div class="blockchain-section">
                    <div class="row">
                        <span class="label"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#64748b" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg> Contrat VehicleRegistry</span>
                        <span class="value">0xd9145CCE52D386f254917e481eB44e9943F39138</span>
                    </div>
                    <div class="row">
                        <span class="label"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#64748b" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Dernière Transaction</span>
                        <span class="value">0xd9145CCE52D386f254917e... (Confirmée)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

