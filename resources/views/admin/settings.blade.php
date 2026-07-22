<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Paramètres & Gestion des Utilisateurs</title>
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
        .content-body { padding: 30px; max-width: 1100px; }
        h1 { font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .subtitle { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .settings-section { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; margin-bottom: 20px; }
        .settings-section h2 { font-size: 16px; font-weight: 600; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 10px; padding-bottom: 14px; border-bottom: 1px solid #334155; }
        .settings-section h2 svg { width: 20px; height: 20px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 6px; color: #94a3b8; font-size: 13px; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 10px 14px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #f1f5f9; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box; }
        .form-group input:focus, .form-group select:focus { border-color: #38bdf8; }
        .alert-success { background: rgba(34, 197, 94, 0.15); color: #4ade80; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(34, 197, 94, 0.2); }
        .save-btn { background: #38bdf8; color: #0b1120; border: none; padding: 10px 28px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s; }
        .save-btn:hover { background: #7dd3fc; }
        .btn-submit { background: linear-gradient(135deg, #38bdf8, #6366f1); color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(56, 189, 248, 0.25); }
        .table-container { background: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; }
        .table-header { padding: 16px 20px; border-bottom: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .table-header h3 { font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; background: #0f172a; border-bottom: 1px solid #1e293b; }
        td { padding: 10px 14px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-actif { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .badge-bloque { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .wallet-cell { font-family: monospace; font-size: 12px; background: rgba(56, 189, 248, 0.1); color: #38bdf8; padding: 2px 6px; border-radius: 4px; }
        .toggle-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #1e293b; }
        .toggle-row:last-child { border-bottom: none; }
        .toggle-label { font-size: 14px; color: #cbd5e1; }
        .toggle-desc { font-size: 12px; color: #64748b; margin-top: 2px; }
        .toggle-switch { width: 44px; height: 24px; background: #334155; border-radius: 12px; cursor: pointer; position: relative; transition: background 0.2s; flex-shrink: 0; }
        .toggle-switch.active { background: #38bdf8; }
        .toggle-switch::after { content: ''; width: 20px; height: 20px; background: #fff; border-radius: 50%; position: absolute; top: 2px; left: 2px; transition: transform 0.2s; }
        .toggle-switch.active::after { transform: translateX(20px); }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
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
            <li><a href="{{ route('admin.contracts') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Smart Contracts</a></li>
            <li><a href="{{ route('admin.factures') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>Facturation</a></li>
            <li><a href="{{ route('admin.historique') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Connexions</a></li>
            <li class="active"><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Directrice Générale — Paramètres & Utilisateurs</div>
            <div class="network-badge"><span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span>Réseau: Ethereum Sepolia</div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Paramètres & Gestion des Utilisateurs
            </h1>
            <div class="subtitle">Configuration système et gestion des comptes utilisateurs de la plateforme.</div>

            @if(session('success'))
                <div class="alert-success"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> {{ session('success') }}</div>
            @endif

            <!-- SECTION: Création d'utilisateur -->
            <div class="settings-section">
                <h2>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Créer un Nouvel Utilisateur
                </h2>
                <p style="color:#64748b;font-size:13px;margin-bottom:18px;">La Directrice Générale peut créer des comptes pour les chauffeurs, garagistes et auditeurs.</p>
                <form action="{{ route('admin.utilisateurs.creer') }}" method="POST">
                    @csrf
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" required placeholder="Ex: Dupont">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" placeholder="Ex: Jean">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required placeholder="Ex: jean.dupont@email.com">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="telephone" placeholder="Ex: 0612345678">
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Wallet Ethereum (adresse)</label>
                            <input type="text" name="wallet_adresse" required placeholder="Ex: 0x...">
                        </div>
                        <div class="form-group">
                            <label>Rôle</label>
                            <select name="role" required>
                                <option value="chauffeur">Chauffeur</option>
                                <option value="garagiste">Garagiste</option>
                                <option value="auditeur">Auditeur</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                        Créer l'Utilisateur
                    </button>
                </form>
            </div>

            <!-- SECTION: Liste des utilisateurs -->
            <div class="settings-section">
                <h2>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Liste des Utilisateurs Enregistrés
                </h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr><th>Utilisateur</th><th>Email</th><th>Rôle</th><th>Wallet</th><th>Statut</th><th>Créé le</th></tr>
                        </thead>
                        <tbody>
                            @forelse($utilisateurs ?? [] as $u)
                            <tr>
                                <td>{{ $u->prenom }} {{ $u->nom }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role === 'directrice_generale' ? 'Directrice Générale' : ucfirst($u->role) }}</td>
                                <td><span class="wallet-cell">{{ Str::limit($u->wallet_adresse, 12) }}</span></td>
                                <td><span class="badge {{ $u->statut_blocage === 'actif' ? 'badge-actif' : 'badge-bloque' }}">{{ $u->statut_blocage === 'actif' ? 'Actif' : 'Bloqué' }}</span></td>
                                <td>{{ $u->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align:center;padding:24px;color:#64748b;">Aucun utilisateur.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION: Configuration Blockchain (existante) -->
            <div class="settings-section">
                <h2><svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>Configuration Blockchain</h2>
                <div class="form-row">
                    <div class="form-group"><label>Réseau Blockchain</label><select><option>Ethereum Sepolia (Testnet)</option><option>Ethereum Mainnet</option></select></div>
                    <div class="form-group"><label>Contrat VehicleRegistry</label><input type="text" value="0xd9145CCE52D386f254917e481eB44e9943F39138" readonly></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>RPC Endpoint</label><input type="text" value="https://sepolia.infura.io/v3/YOUR-PROJECT-ID"></div>
                    <div class="form-group"><label>Chain ID</label><input type="text" value="11155111" readonly></div>
                </div>
                <button class="save-btn"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>Enregistrer</button>
            </div>

            <div class="settings-section">
                <h2><svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Sécurité & Permissions</h2>
                <div class="toggle-row"><div><div class="toggle-label">Authentification par Wallet obligatoire</div><div class="toggle-desc">Les utilisateurs doivent connecter un wallet Ethereum pour se connecter</div></div><div class="toggle-switch active"></div></div>
                <div class="toggle-row"><div><div class="toggle-label">Double Signature pour les transactions</div><div class="toggle-desc">Nécessite 2 signatures pour valider les achats de véhicules</div></div><div class="toggle-switch active"></div></div>
                <div class="toggle-row"><div><div class="toggle-label">Journalisation Blockchain</div><div class="toggle-desc">Enregistrer chaque action dans un registre immuable</div></div><div class="toggle-switch active"></div></div>
            </div>

            <div class="settings-section">
                <h2><svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>Notifications & Alertes</h2>
                <div class="toggle-row"><div><div class="toggle-label">Alerte maintenance préventive</div><div class="toggle-desc">Notifier lorsque le kilométrage approche du seuil de révision</div></div><div class="toggle-switch active"></div></div>
                <div class="toggle-row"><div><div class="toggle-label">Notification blockchain (email)</div><div class="toggle-desc">Recevoir un email pour chaque nouvelle transaction</div></div><div class="toggle-switch"></div></div>
            </div>
        </div>
    </div>
</body>
</html>
