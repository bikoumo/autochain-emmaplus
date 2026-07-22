<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoChain EmmaPlus - Facturation & Ventes</title>
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
        .stat-icon.amber { background: rgba(251, 191, 36, 0.15); }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-info .stat-value { font-size: 24px; font-weight: 700; color: #fff; margin-top: 2px; }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; }
        .card-title { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; padding-bottom: 12px; border-bottom: 1px solid #334155; }

        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; color: #94a3b8; font-size: 13px; font-weight: 500; }
        input, select, textarea { width: 100%; padding: 10px 14px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #f1f5f9; font-size: 13px; outline: none; transition: border-color 0.2s; box-sizing: border-box; }
        input:focus, select:focus, textarea:focus { border-color: #38bdf8; }

        button.submit-btn { background: linear-gradient(135deg, #38bdf8, #0ea5e9); color: #fff; border: none; padding: 11px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; margin-top: 6px; transition: all 0.2s; }
        button.submit-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(56, 189, 248, 0.25); }

        .table-container { background: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; }
        .table-header { padding: 16px 20px; border-bottom: 1px solid #334155; display: flex; justify-content: space-between; align-items: center; }
        .table-header h3 { font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; background: #0f172a; border-bottom: 1px solid #1e293b; }
        td { padding: 12px 16px; font-size: 13px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(56, 189, 248, 0.04); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-vert { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .badge-bleu { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
        .badge-jaune { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
        .badge-rouge { background: rgba(248, 113, 113, 0.15); color: #f87171; }
        .btn-pdf { display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; background: rgba(248, 113, 113, 0.15); color: #f87171; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        .btn-pdf:hover { background: rgba(248, 113, 113, 0.25); }
        .alert-success { background: rgba(34, 197, 94, 0.15); color: #4ade80; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(34, 197, 94, 0.2); }
        .pagination { margin-top: 20px; display: flex; justify-content: center; gap: 8px; }
        .pagination a, .pagination span { padding: 8px 14px; background: #1e293b; border: 1px solid #334155; border-radius: 6px; color: #94a3b8; text-decoration: none; font-size: 13px; }
        .pagination a:hover { border-color: #38bdf8; color: #38bdf8; }
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
            <li class="active"><a href="{{ route('admin.factures') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>Facturation</a></li>
            <li><a href="{{ route('admin.historique') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Connexions</a></li>
            <li><a href="{{ route('admin.parametres') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>Paramètres</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('profil') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Mon Profil</a>
            <a href="{{ route('logout') }}" style="margin-top:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Déconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-title">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Directrice Générale — Facturation & Ventes
            </div>
            <div class="network-badge"><span style="width:8px;height:8px;border-radius:50%;background:#22d3ee;display:inline-block;"></span> Module Financier</div>
        </div>

        <div class="content-body">
            <h1>
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Gestion des Factures & Contrats de Vente
            </h1>
            <div class="subtitle">Gérez les achats de véhicules, les paiements et générez des reçus PDF officiels.</div>

            @if(session('success'))
                <div class="alert-success"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> {{ session('success') }}</div>
            @endif

            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-icon blue"><svg viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Total Factures</div><div class="stat-value">{{ $factures->total() }}</div></div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Véhicules Disponibles</div><div class="stat-value">{{ count($vehicules ?? []) }}</div></div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon amber"><svg viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <div class="stat-info"><div class="stat-label">Montant Total</div><div class="stat-value">{{ number_format($factures->sum('montant_total'), 0, ',', ' ') }} €</div></div>
                </div>
            </div>

            <!-- Création Facture + Liste -->
            <div class="grid-2">
                <!-- Formulaire création -->
                <div class="card">
                    <div class="card-title">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Nouvelle Facture / Contrat de Vente
                    </div>
                    <form action="{{ route('factures.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nom & Prénom de l'Acheteur</label>
                            <input type="text" name="acheteur_nom" required placeholder="Ex: Jean Dupont">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="acheteur_email" required placeholder="Ex: jean.dupont@email.com">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="acheteur_telephone" placeholder="Ex: 0612345678">
                        </div>
                        <div class="form-group">
                            <label>Véhicule</label>
                            <select name="vehicule_id" required>
                                <option value="">Sélectionner un véhicule...</option>
                                @foreach($vehicules ?? [] as $v)
                                <option value="{{ $v->id }}">{{ $v->marque }} {{ $v->modele }} ({{ $v->vin }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type de Véhicule</label>
                            <select name="type_vehicule" required>
                                <option value="occasion">Occasion</option>
                                <option value="neuf">Neuf</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mode de Paiement</label>
                            <select name="mode_paiement" id="mode_paiement" required onchange="toggleTranches()">
                                <option value="cash">Paiement Comptant (Cash)</option>
                                <option value="tranches">Paiement en Plusieurs Tranches</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Montant Total (€)</label>
                            <input type="number" name="montant_total" required step="0.01" min="0" placeholder="Ex: 25000">
                        </div>
                        <div id="tranches_fields" style="display:none;">
                            <div class="form-group">
                                <label>Première Tranche (€)</label>
                                <input type="number" name="premiere_tranche" step="0.01" min="0" placeholder="Ex: 8000">
                            </div>
                            <div class="form-group">
                                <label>Échéancier (détail)</label>
                                <textarea name="echeancier" rows="2" placeholder="Ex: 3 tranches de 5000 € sur 3 mois"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                            Générer la Facture
                        </button>
                    </form>
                </div>

                <!-- Liste des factures -->
                <div>
                    <div class="table-container">
                        <div class="table-header">
                            <h3><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#38bdf8" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg>Factures Récentes</h3>
                        </div>
                        <table>
                            <thead>
                                <tr><th>#</th><th>Acheteur</th><th>Véhicule</th><th>Montant</th><th>Statut</th><th>PDF</th></tr>
                            </thead>
                            <tbody>
                                @forelse($factures as $f)
                                <tr>
                                    <td style="font-weight:600;">#{{ str_pad($f->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $f->acheteur_nom }}</td>
                                    <td>{{ $f->vehicule->marque ?? '—' }} {{ $f->vehicule->modele ?? '' }}</td>
                                    <td style="font-weight:600;">{{ number_format($f->montant_total, 0, ',', ' ') }} €</td>
                                    <td><span class="badge {{ $f->statut === 'paye' ? 'badge-vert' : ($f->statut === 'en_attente' ? 'badge-jaune' : 'badge-rouge') }}">{{ $f->statut === 'paye' ? 'Payé' : ($f->statut === 'en_attente' ? 'En attente' : ucfirst($f->statut)) }}</span></td>
                                    <td><a href="{{ route('factures.pdf', $f->id) }}" class="btn-pdf" target="_blank">📄 PDF</a></td>
                                </tr>
                                @empty
                                <tr><td colspan="6" style="text-align:center;padding:30px;color:#64748b;">Aucune facture pour le moment. Créez-en une !</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">{{ $factures->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleTranches() {
        var mode = document.getElementById('mode_paiement').value;
        document.getElementById('tranches_fields').style.display = mode === 'tranches' ? 'block' : 'none';
    }
    </script>
</body>
</html>
