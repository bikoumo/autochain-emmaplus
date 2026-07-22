<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Certifications Blockchain</title>
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
            background: rgba(167, 139, 250, 0.08);
            color: #e2e8f0;
            border-left-color: #a78bfa;
        }
        .sidebar-menu li.active a {
            background: rgba(167, 139, 250, 0.12);
            color: #a78bfa;
            border-left-color: #a78bfa;
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
            color: #a78bfa;
            font-weight: 500;
            font-size: 13px;
            background: rgba(167, 139, 250, 0.1);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(167, 139, 250, 0.2);
        }
        .content-body { padding: 30px; }

        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 25px; }

        .cert-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .cert-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .cert-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .cert-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #334155;
        }
        .cert-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .cert-icon.purple { background: rgba(167, 139, 250, 0.15); }
        .cert-icon.green { background: rgba(34, 197, 94, 0.15); }
        .cert-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .cert-icon svg { width: 20px; height: 20px; }
        .cert-title { font-size: 14px; font-weight: 600; color: #fff; }
        .cert-date { font-size: 12px; color: #64748b; margin-top: 2px; }

        .cert-detail { display: flex; justify-content: space-between; padding: 6px 0; font-size: 13px; }
        .cert-detail .label { color: #64748b; }
        .cert-detail .value { color: #e2e8f0; font-weight: 500; }
        .cert-detail .hash { color: #22d3ee; font-family: monospace; font-size: 11px; }

        .cert-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        .cert-badge.valid { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .cert-badge.pending { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('garagiste.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Registre Maintenance</a></li>
            <li><a href="{{ route('garagiste.interventions') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>Mes Interventions</a></li>
            <li class="active"><a href="{{ route('garagiste.certifications') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Certifications</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Certifications Blockchain
            </div>
            <div class="role-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#a78bfa;display:inline-block;"></span>
                Connecté — Garagiste
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Certifications des Opérations
            </h1>
            <div class="subtitle">Toutes les interventions certifiées sur la Blockchain sont horodatées et infalsifiables.</div>

            <div class="cert-grid">
                <div class="cert-card">
                    <div class="cert-card-header">
                        <div class="cert-icon purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <div class="cert-title">Vidange + Freins — Toyota RAV4</div>
                            <div class="cert-date">15 Juin 2026 à 14:32</div>
                        </div>
                        <span class="cert-badge valid" style="margin-left:auto;">Validée ✓</span>
                    </div>
                    <div class="cert-detail"><span class="label">Hash Tx</span><span class="hash">0xd9145CCE52D386f254917e481eB44e9943F39138</span></div>
                    <div class="cert-detail"><span class="label">Bloc</span><span class="value">#18,472,301</span></div>
                    <div class="cert-detail"><span class="label">Garage</span><span class="value">Garage Central Dubois</span></div>
                </div>

                <div class="cert-card">
                    <div class="cert-card-header">
                        <div class="cert-icon green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <div class="cert-title">Révision 60 000 km — Hyundai Tucson</div>
                            <div class="cert-date">12 Juin 2026 à 09:15</div>
                        </div>
                        <span class="cert-badge valid" style="margin-left:auto;">Validée ✓</span>
                    </div>
                    <div class="cert-detail"><span class="label">Hash Tx</span><span class="hash">0x766d9145CCE52D386f254917e481eB44e9943</span></div>
                    <div class="cert-detail"><span class="label">Bloc</span><span class="value">#18,472,298</span></div>
                    <div class="cert-detail"><span class="label">Garage</span><span class="value">AutoService Lyon</span></div>
                </div>

                <div class="cert-card">
                    <div class="cert-card-header">
                        <div class="cert-icon blue">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <div class="cert-title">Changement pneus — Honda Civic</div>
                            <div class="cert-date">10 Juin 2026 à 16:45</div>
                        </div>
                        <span class="cert-badge pending" style="margin-left:auto;">En attente</span>
                    </div>
                    <div class="cert-detail"><span class="label">Hash Tx</span><span class="hash">En cours de minage...</span></div>
                    <div class="cert-detail"><span class="label">Bloc</span><span class="value">—</span></div>
                    <div class="cert-detail"><span class="label">Garage</span><span class="value">Marseille Mécanique</span></div>
                </div>

                <div class="cert-card">
                    <div class="cert-card-header">
                        <div class="cert-icon purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <div class="cert-title">Embrayage — Renault Clio</div>
                            <div class="cert-date">08 Juin 2026 à 11:20</div>
                        </div>
                        <span class="cert-badge valid" style="margin-left:auto;">Validée ✓</span>
                    </div>
                    <div class="cert-detail"><span class="label">Hash Tx</span><span class="hash">0x508d9145CCE52D386f254917e481eB44e9943</span></div>
                    <div class="cert-detail"><span class="label">Bloc</span><span class="value">#18,472,290</span></div>
                    <div class="cert-detail"><span class="label">Garage</span><span class="value">Bordeaux Auto Pro</span></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

