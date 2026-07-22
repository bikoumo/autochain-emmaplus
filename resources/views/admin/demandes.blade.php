<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Messagerie Demandes d'Accès</title>
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
        .badge-dg { display: flex; align-items: center; gap: 6px; color: #fbbf24; font-weight: 500; font-size: 13px; background: rgba(251, 191, 36, 0.1); padding: 6px 14px; border-radius: 20px; border: 1px solid rgba(251, 191, 36, 0.2); }
        .content-body { padding: 30px; }
        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 25px; }
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 25px; }
        .stat-box { background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 18px; text-align: center; }
        .stat-box .num { font-size: 28px; font-weight: 700; color: #fff; }
        .stat-box .lbl { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }
        .stat-box.pending { border-color: #fbbf24; } .stat-box.pending .num { color: #fbbf24; }
        .stat-box.green { border-color: #4ade80; } .stat-box.green .num { color: #4ade80; }
        .stat-box.red { border-color: #f87171; } .stat-box.red .num { color: #f87171; }
        .stat-box.blue { border-color: #38bdf8; } .stat-box.blue .num { color: #38bdf8; }
        .alert-success { background: rgba(34, 197, 94, 0.15); color: #4ade80; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 13px; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(34, 197, 94, 0.2); }
        .table-container { background: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; background: #0f172a; border-bottom: 1px solid #1e293b; }
        td { padding: 10px 14px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-attente { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
        .badge-validee { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .badge-refusee { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .btn { display: inline-flex; align-items: center; gap: 4px; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        .btn-valider { background: rgba(34, 197, 94, 0.15); color: #4ade80; } .btn-valider:hover { background: #4ade80; color: #0b1120; }
        .btn-refuser { background: rgba(248, 113, 113, 0.15); color: #f87171; } .btn-refuser:hover { background: #f87171; color: #0b1120; }
        .btn-creer { background: linear-gradient(135deg, #38bdf8, #6366f1); color: #fff; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 13px; } .btn-creer:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(56,189,248,0.3); }
        .msg-cell { font-size: 12px; color: #64748b; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .info-box { background: rgba(56, 189, 248, 0.08); border: 1px solid rgba(56, 189, 248, 0.15); border-radius: 8px; padding: 16px; margin-top: 20px; display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: #94a3b8; line-height: 1.6; }
        .info-box svg { flex-shrink: 0; margin-top: 2px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Tableau de Bord</a></li>
            <li><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.chauffeurs') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Chauffeurs</a></li>
            <li><a href="{{ route('admin.garages') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Garages</a></li>
            <li><a href="{{ route('admin.contracts') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Smart Contracts</a></li>
            <li class="active"><a href="{{ route('admin.demandes') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Demandes d'Accès @if(isset($stats['en_attente']) && $stats['en_attente'] > 0)<span style="background:#f87171;color:#fff;border-radius:10px;padding:2px 8px;font-size:11px;margin-left:auto;">{{ $stats['en_attente'] }}</span>@endif</a></li>
            <li><a href="{{ route('admin.historique') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Connexions</a></li>
            <li><a href="{{ route('admin.factures') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>Facturation</a></li>
            <li><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#fbbf24" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Directrice Générale — Messagerie Demandes</div>
            <div class="badge-dg"><span style="width:8px;height:8px;border-radius:50%;background:#fbbf24;display:inline-block;"></span>DG — BIKOUMOU Theresa Dinilie</div>
        </div>

        <div class="content-body">
            <h1><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Messagerie — Demandes d'Accès</h1>
            <div class="subtitle">Gérez les demandes d'accès des utilisateurs (chauffeurs, garagistes, auditeurs).</div>

            @if(session('success'))
                <div class="alert-success"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> {{ session('success') }}</div>
            @endif

            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-box blue"><div class="num">{{ $stats['total'] ?? 0 }}</div><div class="lbl">Total Demandes</div></div>
                <div class="stat-box pending"><div class="num">{{ $stats['en_attente'] ?? 0 }}</div><div class="lbl">En Attente</div></div>
                <div class="stat-box green"><div class="num">{{ $stats['validees'] ?? 0 }}</div><div class="lbl">Validées</div></div>
                <div class="stat-box red"><div class="num">{{ $stats['refusees'] ?? 0 }}</div><div class="lbl">Refusées</div></div>
            </div>

            <!-- Liste -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>Date</th><th>Demandeur</th><th>Email</th><th>Wallet tenté</th><th>Rôle souhaité</th><th>Message</th><th>Statut</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($demandes ?? [] as $d)
                        <tr>
                            <td style="white-space:nowrap;">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $d->prenom }} {{ $d->nom }}</td>
                            <td style="font-size:12px;">{{ $d->email }}</td>
                            <td><span style="font-family:monospace;font-size:11px;color:#38bdf8;">{{ Str::limit($d->wallet_saisi, 14) }}</span></td>
                            <td>{{ $d->role_souhaite ?? '—' }}</td>
                            <td class="msg-cell" title="{{ $d->message }}">{{ $d->message ?: '—' }}</td>
                            <td>
                                @if($d->statut === 'en_attente') <span class="badge badge-attente">En attente</span>
                                @elseif($d->statut === 'validee') <span class="badge badge-validee">Validée ✓</span>
                                @else <span class="badge badge-refusee">Refusée ✗</span>
                                @endif
                            </td>
                            <td>
                                @if($d->statut === 'en_attente')
                                <form action="{{ route('admin.demandes.valider', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-valider" onclick="return confirm('Valider la demande de {{ $d->prenom }} {{ $d->nom }} ? Ensuite créez son compte dans Paramètres.')">
                                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Valider
                                    </button>
                                </form>
                                <form action="{{ route('admin.demandes.refuser', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-refuser" onclick="return confirm('Refuser la demande de {{ $d->prenom }} {{ $d->nom }} ?')">
                                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> Refuser
                                    </button>
                                </form>
                                @elseif($d->statut === 'validee')
                                <span style="color:#64748b;font-size:12px;">✅ Compte à créer</span>
                                @else
                                <span style="color:#64748b;font-size:12px;">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" style="text-align:center;padding:30px;color:#64748b;">Aucune demande d'accès pour le moment.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tentatives de connexion échouées -->
            <h2 style="font-size:18px;font-weight:600;color:#fff;margin:30px 0 12px;display:flex;align-items:center;gap:10px;">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#f87171" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Journal des Tentatives de Connexion Échouées
                @if(isset($stats['tentatives_echouees']) && $stats['tentatives_echouees'] > 0)
                    <span style="background:#f87171;color:#fff;border-radius:10px;padding:3px 10px;font-size:12px;">{{ $stats['tentatives_echouees'] }}</span>
                @endif
            </h2>
            <div class="subtitle" style="margin-bottom:16px;">Toutes les tentatives de connexion échouées (utilisateurs inexistants, bloqués ou mauvais wallet) sont enregistrées ici avec les informations saisies.</div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>Date</th><th>Email tenté</th><th>Nom / Prénom</th><th>Wallet tenté</th><th>Rôle</th><th>Motif</th><th>IP</th></tr>
                    </thead>
                    <tbody>
                        @forelse($tentativesEchouees ?? [] as $t)
                        <tr>
                            <td style="white-space:nowrap;">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                            <td style="font-size:12px;">{{ $t->email }}</td>
                            <td>{{ $t->prenom }} {{ $t->nom }}</td>
                            <td><span style="font-family:monospace;font-size:11px;color:#f87171;">{{ $t->email === 'Non renseigné' ? '—' : 'Wallet enregistré' }}</span></td>
                            <td>{{ $t->role === 'inconnu' ? 'Non inscrit' : ucfirst($t->role) }}</td>
                            <td>
                                @if($t->utilisateur_id === null)
                                    <span class="badge badge-refusee">Compte inexistant</span>
                                @elseif($t->statut_blocage === 'bloque')
                                    <span class="badge badge-refusee">Compte bloqué</span>
                                @else
                                    <span class="badge badge-refusee">Mauvais wallet</span>
                                @endif
                            </td>
                            <td style="font-family:monospace;font-size:11px;color:#64748b;">{{ $t->ip_adresse }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" style="text-align:center;padding:30px;color:#64748b;">Aucune tentative de connexion échouée enregistrée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="info-box">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                <div>
                    <strong style="color:#e2e8f0;">Flux de validation :</strong><br>
                    <strong>1.</strong> Examinez la demande ci-dessus. <strong>2.</strong> Cliquez sur <strong>"Valider"</strong>. <strong>3.</strong> Allez dans <a href="{{ route('admin.parametres') }}" style="color:#38bdf8;text-decoration:none;">Paramètres → Créer un Utilisateur</a> pour créer son compte avec l'email et wallet qu'il a fournis.<br>
                    <span style="color:#64748b;">Contact DG : 053909481 | bikoumoutheresa@gmail.com</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
