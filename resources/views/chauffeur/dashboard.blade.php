<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Espace Chauffeur</title>
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
        .stat-icon { width: 46px; height: 46px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .stat-icon.green { background: rgba(34, 197, 94, 0.15); }
        .stat-icon.amber { background: rgba(251, 191, 36, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }

        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 24px;
            max-width: 620px;
        }
        .card-title { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
        .form-group { margin-bottom: 18px; }
        label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
        }
        label svg { width: 14px; height: 14px; flex-shrink: 0; }
        input, select, textarea {
            width: 100%;
            padding: 11px 14px;
            background: #0b1120;
            border: 1px solid #334155;
            color: #f1f5f9;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus, select:focus, textarea:focus { border-color: #38bdf8; }
        button {
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            color: #fff;
            border: none;
            padding: 11px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
            transition: all 0.2s;
        }
        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3);
        }
        .info-note {
            margin-top: 18px;
            padding: 12px 16px;
            background: rgba(56, 189, 248, 0.08);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 8px;
            font-size: 13px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-note svg { width: 16px; height: 16px; flex-shrink: 0; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li class="active"><a href="{{ route('chauffeur.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Espace Chauffeur</a></li>
            <li><a href="{{ route('chauffeur.trajets') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Mes Trajets</a></li>
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
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Espace Chauffeur
            </div>
            <div class="role-badge">
                <span style="width:8px;height:8px;border-radius:50%;background:#4ade80;display:inline-block;"></span>
                Connecté — Chauffeur
            </div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Déclaration de Trajet & Carburant
            </h1>
            <div class="subtitle">Enregistrez vos actions sur la Blockchain en un clic.</div>

            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Mon Véhicule</div>
                        <div class="stat-value" style="font-size:18px;font-weight:600;">Toyota RAV4</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Trajets Aujourd'hui</div>
                        <div class="stat-value">3</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Kilométrage Actuel</div>
                        <div class="stat-value">45,200</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Nouvelle Déclaration Blockchain
                </div>
                <form method="POST" action="{{ route('chauffeur.trajets') }}" onsubmit="alert('Déclaration soumise. Fonctionnalité Blockchain active.'); return false;">
                    @csrf
                    <div class="form-group">
                        <label>
                            <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18" r="2.5"/><circle cx="18.5" cy="18" r="2.5"/></svg>
                            Véhicule Attitré
                        </label>
                        <select name="vehicule">
                            <option>1HGCR2F8300 (Toyota RAV4 - En Mission)</option>
                            <option>1HGCR2F83307 (RAV4 - Disponible)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            Type d'Événement
                        </label>
                        <select name="type_evenement">
                            <option>Déclaration de Prise en Charge</option>
                            <option>Saisie Kilométrique / Plein de Carburant</option>
                            <option>Déclaration de Fin de Trajet</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Nouveau Kilométrage
                        </label>
                        <input type="number" name="kilometrage" placeholder="Ex: 46200">
                    </div>
                    <button type="submit">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        Enregistrer sur la Blockchain
                    </button>
                </form>
                <div class="info-note">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Toute déclaration est horodatée et enregistrée de façon immuable sur la Blockchain Ethereum.
                </div>
            </div>
        </div>
    </div>
</body>
</html>

