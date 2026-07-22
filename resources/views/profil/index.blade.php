<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Mon Profil</title>
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
        .main { flex: 1; display: flex; flex-direction: column; overflow-y: auto; padding: 30px; }
        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; }
        .profile-card { background: #1e293b; border: 1px solid #334155; border-radius: 14px; padding: 32px; max-width: 600px; }
        .profile-header { display: flex; align-items: center; gap: 20px; margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid #334155; }
        .avatar { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; flex-shrink: 0; }
        .profile-name { font-size: 20px; font-weight: 700; color: #fff; }
        .profile-role { font-size: 13px; color: #64748b; margin-top: 4px; display: flex; align-items: center; gap: 6px; }
        .profile-role .badge { padding: 2px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .info-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .info-value { font-size: 14px; color: #e2e8f0; font-weight: 500; }
        .btn-back { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: #1e293b; border: 1px solid #334155; border-radius: 8px; color: #38bdf8; text-decoration: none; font-size: 13px; font-weight: 500; margin-bottom: 20px; transition: all 0.2s; }
        .btn-back:hover { border-color: #38bdf8; background: rgba(56, 189, 248, 0.08); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            AutoChain EmmaPlus
        </div>
        <ul class="sidebar-menu">
            <li class="active"><a href="#"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a></li>
            @php $role = session('utilisateur_role', ''); @endphp
            @if($role === 'directrice_generale')
            <li><a href="{{ route('admin.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>Tableau de Bord</a></li>
            <li><a href="{{ route('admin.parc') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-6.77-6.77L14.7 6.3z"/></svg>Gestion du Parc</a></li>
            <li><a href="{{ route('admin.factures') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>Facturation</a></li>
            @elseif($role === 'chauffeur')
            <li><a href="{{ route('chauffeur.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Mon Tableau de Bord</a></li>
            @elseif($role === 'garagiste')
            <li><a href="{{ route('garagiste.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Mon Tableau de Bord</a></li>
            @elseif($role === 'auditeur')
            <li><a href="{{ route('auditeur.timeline') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Timeline & Achat</a></li>
            @endif
            <li><a href="{{ route('logout') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a></li>
        </ul>
        <div class="sidebar-footer">
            <span style="color: #64748b; font-size: 12px;">Connecté en tant que {{ session('utilisateur_prenom', '') }} {{ session('utilisateur_nom', '') }}</span>
        </div>
    </div>
    <div class="main">
        <a href="{{ $role === 'directrice_generale' ? route('admin.dashboard') : ($role === 'chauffeur' ? route('chauffeur.dashboard') : ($role === 'garagiste' ? route('garagiste.dashboard') : route('auditeur.timeline'))) }}" class="btn-back">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Retour au Tableau de Bord
        </a>

        <h1>
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Mon Profil
        </h1>

        <div class="profile-card">
            @php
                $nom = session('utilisateur_nom', 'Utilisateur');
                $prenom = session('utilisateur_prenom', '');
                $email = session('utilisateur_email', '—');
                $telephone = session('utilisateur_telephone', '—');
                $role = session('utilisateur_role', '—');
                $avatarBg = $role === 'directrice_generale' ? 'rgba(236, 72, 153, 0.2)' : 'rgba(56, 189, 248, 0.2)';
                $avatarIcon = $role === 'directrice_generale' ? '👩‍💼' : ($role === 'chauffeur' ? '🚗' : ($role === 'garagiste' ? '🔧' : '📋'));
            @endphp

            <div class="profile-header">
                <div class="avatar" style="background: {{ $avatarBg }};">
                    <span>{{ $avatarIcon }}</span>
                </div>
                <div>
                    <div class="profile-name">{{ $prenom }} {{ $nom }}</div>
                    <div class="profile-role">
                        Rôle :
                        <span class="badge" style="background: {{ $avatarBg }}; color: {{ $role === 'directrice_generale' ? '#f472b6' : '#38bdf8' }};">
                            {{ $role === 'directrice_generale' ? 'Directrice Générale' : ($role === 'chauffeur' ? 'Chauffeur' : ($role === 'garagiste' ? 'Garagiste' : 'Auditeur')) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Prénom</div>
                    <div class="info-value">{{ $prenom ?: '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Nom</div>
                    <div class="info-value">{{ $nom }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Téléphone</div>
                    <div class="info-value">{{ $telephone ?: '—' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Rôle</div>
                    <div class="info-value">{{ ucfirst($role) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Statut</div>
                    <div class="info-value" style="color: #4ade80;">Actif</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
