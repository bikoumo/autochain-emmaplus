<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AutoChain EmmaPlus - Gestion des Véhicules</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #0f172a; color: #fff; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: #1e293b; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        h1 { color: #f97316; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #cbd5e1; }
        input { width: 100%; padding: 10px; border: 1px solid #475569; background: #0f172a; color: #fff; border-radius: 5px; }
        button { background: #f97316; color: white; padding: 10px 15px; border: none; border-radius: 5px; width: 100%; font-size: 16px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #ea580c; }
        .alert { background: #22c55e; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Directrice Générale — AutoChain</h1>
        <p style="text-align: center; color: #94a3b8;">Enregistrement d'un véhicule sécurisé</p>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Numéro VIN (17 caractères) :</label>
                <input type="text" name="vin" required maxlength="17" placeholder="Ex: 1HGCR2F83HA000000">
            </div>
            <div class="form-group">
                <label>Marque :</label>
                <input type="text" name="marque" required placeholder="Ex: Toyota">
            </div>
            <div class="form-group">
                <label>Modèle :</label>
                <input type="text" name="modele" required placeholder="Ex: RAV4">
            </div>
            <div class="form-group">
                <label>Adresse du Propriétaire (Ethereum / 42 caractères) :</label>
                <input type="text" name="proprietaire_adresse" required placeholder="Ex: 0x5B3...edDC4">
            </div>
            <div class="form-group">
                <label>Kilométrage :</label>
                <input type="number" name="kilometrage" placeholder="Ex: 45000">
            </div>
            <button type="submit">Enregistrer le Véhicule</button>
        </form>
    </div>
</body>
</html>