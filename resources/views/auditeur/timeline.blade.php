<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Timeline & Achat</title>
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

        .main { flex: 1; padding: 30px; overflow-y: auto; }
        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 24px; }

        .timeline-container { max-width: 800px; }
        .timeline-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
        }
        .timeline-card h3 {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 14px;
            border-bottom: 1px solid #334155;
        }
        .timeline-item {
            border-left: 2px solid #38bdf8;
            padding-left: 18px;
            padding-bottom: 18px;
            position: relative;
        }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-item::before {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background: #38bdf8;
            border-radius: 50%;
            left: -6px;
            top: 4px;
        }
        .timeline-item .date { color: #64748b; font-size: 12px; display: flex; align-items: center; gap: 6px; margin-bottom: 4px; }
        .timeline-item .title { color: #fff; font-weight: 600; font-size: 14px; margin-bottom: 4px; }
        .timeline-item .hash { color: #22d3ee; font-family: monospace; font-size: 12px; display: flex; align-items: center; gap: 6px; }

        .buy-box {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 1px solid #38bdf8;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            max-width: 800px;
        }
        .buy-box h3 {
            font-size: 16px;
            color: #fff;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .buy-box p { color: #94a3b8; font-size: 14px; margin-bottom: 16px; }
        .btn-buy {
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3);
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
            <li class="active"><a href="#">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                Timeline & Achat
            </a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>
    <div class="main">
        <h1>
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Timeline & Historique Certifié
        </h1>
        <div class="subtitle">Consultez l'historique immuable et infalsifiable de chaque véhicule avant acquisition.</div>

        <div class="timeline-container">
            <div class="timeline-card">
                <h3>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>
                    Véhicule : Toyota RAV4 (VIN: 1HGCR2F83...)
                </h3>
                <div class="timeline-item">
                    <div class="date">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#64748b" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        15 Mai 2026
                    </div>
                    <div class="title">Certification Garage : Vidange et Freins</div>
                    <div class="hash">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#22d3ee" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        Hash Tx : 0xd9145CCE52D386f254917e...
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="date">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#64748b" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        10 Mars 2026
                    </div>
                    <div class="title">Enregistrement initial du véhicule sur la Blockchain</div>
                    <div class="hash">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#22d3ee" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        Hash Tx : 0x766d9145CCE52D386f...
                    </div>
                </div>
            </div>

            <div class="timeline-card">
                <h3>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>
                    Véhicule : Honda Civic (VIN: 2HGFA2F83...)
                </h3>
                <div class="timeline-item">
                    <div class="date">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#64748b" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        08 Fév 2026
                    </div>
                    <div class="title">Mise à jour kilométrique : 45 200 km</div>
                    <div class="hash">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#22d3ee" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        Hash Tx : 0x508d9145CCE52D386f...
                    </div>
                </div>
            </div>

            <div class="buy-box">
                <h3>
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Module de Transaction Sécurisé
                </h3>
                <p>Validez l'acquisition de ce véhicule de façon transparente et infalsifiable via la double signature blockchain.</p>
                <button class="btn-buy">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Signer la Double Transaction d'Achat
                </button>
            </div>
        </div>
    </div>
</body>
</html>

