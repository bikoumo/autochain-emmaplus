<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrat de Vente — Facture #{{ $facture->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1e293b; padding: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #38bdf8; padding-bottom: 20px; }
        .header h1 { font-size: 20px; color: #0b1120; margin: 0 0 5px; }
        .header p { color: #64748b; margin: 0; font-size: 11px; }
        .company-name { font-size: 16px; font-weight: bold; color: #38bdf8; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 14px; font-weight: bold; color: #0b1120; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { text-align: left; padding: 6px 8px; background: #f1f5f9; font-size: 11px; text-transform: uppercase; }
        td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; font-size: 12px; }
        .total-row td { font-weight: bold; background: #f8fafc; }
        .signatures { margin-top: 40px; display: flex; justify-content: space-between; }
        .signature-box { width: 45%; }
        .signature-box h4 { font-size: 12px; color: #64748b; margin-bottom: 5px; }
        .signature-line { border-top: 1px solid #94a3b8; margin-top: 50px; padding-top: 6px; font-size: 10px; color: #64748b; text-align: center; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 15px; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .badge-cash { background: #dcfce7; color: #166534; }
        .badge-tranches { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">AutoChain EmmaPlus</div>
        <h1>CONTRAT DE VENTE — FACTURE #{{ str_pad($facture->id, 4, '0', STR_PAD_LEFT) }}</h1>
        <p>Plateforme de Gestion de Parc Automobile — Blockchain & Smart Contracts</p>
        <p style="margin-top:4px;">Date : {{ $facture->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <div class="section-title">📋 Informations de l'Acheteur</div>
        <table>
            <tr><td style="width:120px;font-weight:bold;">Nom complet</td><td>{{ $facture->acheteur_nom }}</td></tr>
            <tr><td style="font-weight:bold;">Email</td><td>{{ $facture->acheteur_email }}</td></tr>
            <tr><td style="font-weight:bold;">Téléphone</td><td>{{ $facture->acheteur_telephone ?: '—' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">🚗 Détails du Véhicule</div>
        <table>
            <thead>
                <tr><th>VIN</th><th>Marque / Modèle</th><th>Propriétaire</th><th>Type</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $facture->vehicule->vin ?? '—' }}</td>
                    <td>{{ $facture->vehicule->marque ?? '' }} {{ $facture->vehicule->modele ?? '' }}</td>
                    <td>{{ $facture->vehicule ? Str::limit($facture->vehicule->proprietaire_adresse, 12) : '—' }}</td>
                    <td><span class="badge {{ $facture->type_vehicule === 'neuf' ? 'badge-cash' : 'badge-tranches' }}">{{ $facture->type_vehicule === 'neuf' ? 'Neuf' : 'Occasion' }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">💰 Modalités de Paiement</div>
        <table>
            <tr><td style="width:160px;font-weight:bold;">Mode de paiement</td><td><span class="badge {{ $facture->mode_paiement === 'cash' ? 'badge-cash' : 'badge-tranches' }}">{{ $facture->mode_paiement === 'cash' ? 'Paiement Comptant' : 'Paiement en Plusieurs Tranches' }}</span></td></tr>
            <tr><td style="font-weight:bold;">Montant total</td><td style="font-size:16px;font-weight:bold;">{{ number_format($facture->montant_total, 0, ',', ' ') }} €</td></tr>
            @if($facture->mode_paiement === 'tranches' && $facture->premiere_tranche)
            <tr><td style="font-weight:bold;">Première tranche</td><td>{{ number_format($facture->premiere_tranche, 0, ',', ' ') }} €</td></tr>
            @endif
            @if($facture->echeancier)
            <tr><td style="font-weight:bold;">Échéancier</td><td>{{ $facture->echeancier }}</td></tr>
            @endif
            <tr><td style="font-weight:bold;">Statut</td><td><span class="badge {{ $facture->statut === 'paye' ? 'badge-cash' : 'badge-tranches' }}">{{ $facture->statut === 'paye' ? 'Payé' : ($facture->statut === 'en_attente' ? 'En attente' : ucfirst($facture->statut)) }}</span></td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">🏢 Informations du Vendeur</div>
        <table>
            <tr><td style="width:160px;font-weight:bold;">Société</td><td>AutoChain EmmaPlus</td></tr>
            <tr><td style="font-weight:bold;">Représentant</td><td>BIKOUMOU Theresa Dinilie — Directrice Générale</td></tr>
            <tr><td style="font-weight:bold;">Contact</td><td>053909481 / bikoumoutheresa@gmail.com</td></tr>
            <tr><td style="font-weight:bold;">Wallet Ethereum</td><td style="font-family:monospace;font-size:11px;">0xd9145CCE52D386f254917e481eB44e9943F39138</td></tr>
            <tr><td style="font-weight:bold;">Réseau</td><td>Ethereum Mainnet</td></tr>
        </table>
    </div>

    <div class="signatures">
        <div class="signature-box">
            <h4>Signature de l'Acheteur</h4>
            <div class="signature-line">___________________________</div>
            <p style="font-size:10px;color:#64748b;margin-top:4px;">Cachet et signature</p>
        </div>
        <div class="signature-box">
            <h4>Signature du Vendeur</h4>
            <div class="signature-line">___________________________</div>
            <p style="font-size:10px;color:#64748b;margin-top:4px;">BIKOUMOU Theresa Dinilie</p>
        </div>
    </div>

    <div class="footer">
        <p><strong>AutoChain EmmaPlus</strong> — Tous droits réservés &copy; {{ date('Y') }}</p>
        <p>Ce document est généré électroniquement et fait office de contrat de vente officiel.</p>
        <p>Adresse du Smart Contract : 0xd9145CCE52D386f254917e481eB44e9943F39138</p>
        <p style="margin-top:8px;font-size:9px;color:#94a3b8;">Document signé via la plateforme AutoChain EmmaPlus — Blockchain Ethereum</p>
    </div>
</body>
</html>
