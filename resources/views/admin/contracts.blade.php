<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Smart Contracts</title>
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
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-box:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .stat-icon.green { background: rgba(34, 197, 94, 0.15); }
        .stat-icon.cyan { background: rgba(34, 211, 238, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }

        .contract-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px; }
        .contract-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .contract-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .contract-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .contract-icon {
            width: 40px; height: 40px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .contract-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .contract-icon.purple { background: rgba(167, 139, 250, 0.15); }
        .contract-icon.green { background: rgba(34, 197, 94, 0.15); }
        .contract-icon.amber { background: rgba(251, 191, 36, 0.15); }
        .contract-icon svg { width: 20px; height: 20px; }
        .contract-title { font-size: 15px; font-weight: 600; color: #fff; }
        .contract-address { font-size: 12px; color: #64748b; font-family: monospace; margin-top: 2px; }
        .contract-detail { font-size: 13px; color: #94a3b8; margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
        .contract-detail strong { color: #e2e8f0; }

        .tx-table {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            overflow: hidden;
        }
        .tx-table .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .tx-table .table-header h3 { font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px; }
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
        td { padding: 14px 16px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }
        .tx-hash { color: #22d3ee; font-family: monospace; font-size: 12px; }
        .tx-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }
        .tx-status.confirmed { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .tx-status.pending { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
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
            <li><a href="{{ route('admin.garages') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Garages</a></li>
            <li class="active"><a href="{{ route('admin.contracts') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>Smart Contracts</a></li>
            <li><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('login') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
Directrice Générale — Smart Contracts
            </div>
            <div class="network-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>
                Réseau: Ethereum Sepolia
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Smart Contracts Déployés
            </h1>
            <div class="subtitle">Visualisez et interagissez avec les contrats intelligents de la plateforme.</div>

            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Contrats Déployés</div>
                        <div class="stat-value">4</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Transactions Confirmées</div>
                        <div class="stat-value">1,284</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon cyan">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22d3ee" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><link><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Véhicules Enregistrés</div>
                        <div class="stat-value">125</div>
                    </div>
                </div>
            </div>

            <div class="contract-grid">
                <div class="contract-card">
                    <div class="contract-header">
                        <div class="contract-icon blue">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <div>
                            <div class="contract-title">VehicleRegistry</div>
                            <div class="contract-address">0xd9145CCE52D386f254917e481eB44e9943F39138</div>
                        </div>
                    </div>
                    <div class="contract-detail"><strong>Réseau :</strong> Ethereum Sepolia</div>
                    <div class="contract-detail"><strong>Propriétaire :</strong> 0x5B38Da6a701c568545dCfcB03FcB875f56beddC4</div>
                    <div class="contract-detail"><strong>Créé le :</strong> 15/07/2026</div>
                </div>
                <div class="contract-card">
                    <div class="contract-header">
                        <div class="contract-icon purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <div class="contract-title">AccessControl</div>
                            <div class="contract-address">0x7A2...11BB — 0x7A2...11BB</div>
                        </div>
                    </div>
                    <div class="contract-detail"><strong>Réseau :</strong> Ethereum Sepolia</div>
                    <div class="contract-detail"><strong>Rôles :</strong> Admin, Chauffeur, Garagiste, Auditeur</div>
                    <div class="contract-detail"><strong>Créé le :</strong> 10/07/2026</div>
                </div>
            </div>

            <div class="tx-table">
                <div class="table-header">
                    <h3>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        Dernières Transactions Blockchain
                    </h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Hash Transaction</th>
                            <th>Méthode</th>
                            <th>Véhicule</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="tx-hash">0xd9145CCE52D386f254917e...</span></td>
                            <td>Enregistrement</td>
                            <td>Toyota RAV4</td>
                            <td><span class="tx-status confirmed">Confirmée</span></td>
                            <td>15/06/2026</td>
                        </tr>
                        <tr>
                            <td><span class="tx-hash">0x766d9145CCE52D386f254...</span></td>
                            <td>Certification Maintenance</td>
                            <td>Hyundai Tucson</td>
                            <td><span class="tx-status confirmed">Confirmée</span></td>
                            <td>12/06/2026</td>
                        </tr>
                        <tr>
                            <td><span class="tx-hash">0x508d9145CCE52D386f254...</span></td>
                            <td>Mise à jour Kilométrage</td>
                            <td>Honda Civic</td>
                            <td><span class="tx-status pending">En attente</span></td>
                            <td>10/06/2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

