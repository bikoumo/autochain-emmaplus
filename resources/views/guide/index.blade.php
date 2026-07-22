<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Guide de l'Application</title>
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
        .content-body { padding: 30px; max-width: 900px; }

        h1 { font-size: 26px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; }
        .subtitle-guide { color: #64748b; font-size: 14px; margin-bottom: 30px; }

        .section { margin-bottom: 32px; }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #38bdf8;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #1e293b;
        }
        .section-title svg { width: 22px; height: 22px; flex-shrink: 0; }
        .card-guide {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 12px;
        }
        .card-guide h3 {
            color: #f1f5f9;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-guide h3 svg { width: 16px; height: 16px; flex-shrink: 0; }
        .card-guide p, .card-guide li {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.7;
        }
        .card-guide ul {
            padding-left: 20px;
            margin-top: 6px;
        }
        .card-guide li { margin-bottom: 4px; }
        .card-guide strong { color: #cbd5e1; }
        .badge-role {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-dg { background: rgba(56,189,248,0.15); color: #38bdf8; }
        .badge-chauffeur { background: rgba(34,211,238,0.15); color: #22d3ee; }
        .badge-garagiste { background: rgba(52,211,153,0.15); color: #34d399; }
        .badge-auditeur { background: rgba(251,191,36,0.15); color: #fbbf24; }
        .contact-info {
            background: rgba(56,189,248,0.08);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 10px;
            padding: 16px 20px;
            margin-top: 16px;
        }
        .contact-info p { color: #94a3b8; font-size: 14px; line-height: 1.8; }
        .contact-info strong { color: #f1f5f9; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            @php $role = session('utilisateur_role', 'non_connecte'); @endphp

            @if($role === 'directrice_generale')
            <li><a href="{{ route('admin.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Tableau de Bord</a></li>
            <li><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/><path d="M12.5 19.5A4.5 4.5 0 0 1 8 15.5V11.5A2 2 0 0 1 10 9.5h4a2 2 0 0 1 2 2v4a4.5 4.5 0 0 1-3.5 4"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.demandes') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Demandes d'Accès</a></li>
            @elseif($role === 'chauffeur')
            <li><a href="{{ route('chauffeur.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>Espace Chauffeur</a></li>
            @elseif($role === 'garagiste')
            <li><a href="{{ route('garagiste.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>Espace Garagiste</a></li>
            @elseif($role === 'auditeur')
            <li><a href="{{ route('auditeur.timeline') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>Timeline & Achat</a></li>
            @endif
            <li class="active"><a href="{{ route('guide') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Guide de l'App</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title">
