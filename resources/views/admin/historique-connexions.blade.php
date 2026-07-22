<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Historique des Connexions</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, sans-serif; background-color: #0b1120; color: #f1f5f9; display: flex; height: 100vh; overflow: hidden; }
        .sidebar { width: 270px; background: linear-gradient(180deg, #0f172a 0%, #0b1120 100%); border-right: 1px solid #1e293b; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 24px 20px; font-size: 18px; font-weight: 700; color: #38bdf8; border-bottom: 1px solid #1e293b; display: flex; align-items: center; gap: 10px; }
        .sidebar-menu { list-style: none; padding: 12px 0; flex: 1; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease; border-left: 3px solid transparent; }
        .sidebar-menu li a:hover { background: rgba(56, 189, 248, 0.08); color: #e2e8f0; border-left-color: #38bdf8; }
        .sidebar-menu li.active a { background: rgba(56, 189, 248, 0.12); color: #38bdf8; border-left-color: #38bdf8; }
        .sidebar-menu li a svg { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid #1e293b; }
        .sidebar-footer a { display: flex; align-items: center; gap: 10px; color: #64748b; text-decoration: none; font-size: 13px; font-weight: 500; transition: color 0.2s; }
        .sidebar-footer a:hover { color: #ef4444; }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .header { padding: 16px 30px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px); border-bottom: 1px solid #1e293b; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 10; }
        .header-title { font-size: 15px; font-weight: 600; color: #f1f5f9; display: flex; align-items: center; gap: 8px; }
        .network-badge { display: flex; align-items: center; gap: 6px; color: #22d3ee; font-weight: 500; font-size: 13px; background: rgba(34, 211, 238, 0.1); padding: 6px 14px; border-radius: 20px; border: 1px solid rgba(34, 211, 238, 0.2); }
        .content-body { padding: 30px; }
        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 25px; }
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-box { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 46px; height: 46px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); }
        .stat-icon.green { background: rgba(34, 197, 94, 0.15); }
        .stat-icon.red { background: rgba(248, 113, 113, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }
        .table-container { background: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; }
        .table-header { padding: 16px 20px; border-bottom: 1px solid #334155; }
        .table-header h3 { font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; background: #0f172a; border-bottom: 1px solid #1e293b; }
        td { padding: 14px 16px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }
        .role-icon { font-size: 16px; }
        .btn-block, .btn-unblock { padding: 6px 14px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .btn-block { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .btn-block:hover { background: rgba(248, 113, 113, 0.25); }
        .btn-unblock { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .btn-unblock:hover { background: rgba(34, 197, 94, 0.25); }
        .badge-bloque { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .badge-actif { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .alert-success { background: rgba(34, 197, 94, 0.15); color: #4ade80; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(34, 197, 94, 0.2); }
        .pagination { margin-top: 20px; display: flex; justify-content: center; gap: 8px; }
        .pagination a, .pagination span { padding: 8px 14px; background: #1e293b; border: 1px solid #334155; border-radius: 6px; color: #94a3b8; text-decoration: none; font-size: 13px; }
        .pagination a:hover { border-color: #38bdf8; color: #38bdf8; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">AutoChain EmmaPlus</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Tableau de Bord</a></li>
            <li class="active"><a href="{{ route('admin.historique') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Historique Connexions</a></li>
            <li><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.factures') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/></svg>Facturation</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('logout') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>
    <div class="main-content">
        <div class="header">
            <div class="header-title"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Directrice Générale — Historique des Connexions</div>
            <div class="network-badge"><span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>Sécurité Active</div>
        </div>
        <div class="content-body">
            <h1><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Historique des Connexions</h1>
            <div class="subtitle">Suivi dynamique de toutes les connexions — Bloquez ou réactivez un accès.</div>

            @if(session('success'))
                <div class="alert-success"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> {{ session('success') }}</div>
            @endif

            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-icon blue"><svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Total Connexions</div><div class="stat-value">{{ $stats['total'] }}</div></div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Aujourd'hui</div><div class="stat-value">{{ $stats['aujourdhui'] }}</div></div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon red"><svg viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Bloqués</div><div class="stat-value">{{ $stats['bloques'] }}</div></div>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header"><h3><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Registre des Connexions</h3></div>
                <table>
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($connexions as $connexion)
                        @php
                            $roleIcon = $connexion->role === 'directrice_generale' ? '👩‍💼' : ($connexion->role === 'chauffeur' ? '🚗' : ($connexion->role === 'garagiste' ? '🔧' : '📋'));
                            $utilisateur = \App\Models\Utilisateur::find($connexion->utilisateur_id);
                            $estBloque = $utilisateur && $utilisateur->statut_blocage === 'bloque';
                        @endphp
                        <tr>
                            <td><span class="role-icon">{{ $roleIcon }}</span> {{ $connexion->prenom }} {{ $connexion->nom }}</td>
                            <td>{{ $connexion->email }}</td>
                            <td>{{ $connexion->role === 'directrice_generale' ? 'Directrice Générale' : ucfirst($connexion->role) }}</td>
                            <td>
                                @if($estBloque)
                                    <span class="badge-bloque">🔒 Bloqué</span>
                                @else
                                    <span class="badge-actif">✅ Actif</span>
                                @endif
                            </td>
                            <td>{{ $connexion->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($utilisateur)
                                    @if($estBloque)
                                        <form action="{{ route('admin.utilisateurs.debloquer', $utilisateur->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-unblock">Débloquer</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.utilisateurs.bloquer', $utilisateur->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bloquer cet utilisateur ? Il ne pourra plus se connecter.');">
                                            @csrf
                                            <button type="submit" class="btn-block">Bloquer</button>
                                        </form>
                                    @endif
                                @else
                                    <span style="color:#64748b;font-size:12px;">Compte supprimé</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" style="text-align:center;padding:30px;color:#64748b;">Aucune connexion enregistrée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination">{{ $connexions->links() }}</div>
        </div>
    </div>
</body>
</html>
