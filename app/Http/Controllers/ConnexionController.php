<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Connexion;

class ConnexionController extends Controller
{
    /**
     * Authentifie un utilisateur par email + wallet
     * Enregistre la connexion et vérifie le blocage
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'wallet' => 'required|string',
        ]);

        $email = $request->input('email');
        $wallet = $request->input('wallet');

        $utilisateur = Utilisateur::where('email', $email)->first();

        if (!$utilisateur) {
            // Enregistrer automatiquement la demande dans la messagerie DG
            \App\Models\Demande::create([
                'nom' => 'Non renseigné',
                'email' => $email,
                'wallet_saisi' => $wallet ?? '',
                'role_souhaite' => 'non précisé',
                'statut' => 'en_attente',
                'message' => 'Tentative de connexion automatique — email: ' . $email . ', wallet: ' . ($wallet ?? 'non fourni'),
                'ip_adresse' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Enregistrer la tentative échouée dans le journal des connexions
            Connexion::create([
                'utilisateur_id' => null,
                'nom' => 'Non renseigné',
                'prenom' => '',
                'email' => $email,
                'telephone' => '',
                'role' => 'inconnu',
                'statut_blocage' => 'actif',
                'statut_connexion' => 'echec',
                'ip_adresse' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('login')->with([
                'error' => 'Vous n\'êtes pas éligible pour vous connecter. Veuillez contacter la Directrice Générale (BIKOUMOU Theresa Dinilie, Tél: 053909481, Email: bikoumoutheresa@gmail.com).',
            ]);
        }

        // Vérifier si l'utilisateur est bloqué
        if ($utilisateur->statut_blocage === 'bloque') {
            // Enregistrer la tentative échouée (bloqué) dans le journal des connexions
            Connexion::create([
                'utilisateur_id' => $utilisateur->id,
                'nom' => $utilisateur->nom,
                'prenom' => $utilisateur->prenom,
                'email' => $utilisateur->email,
                'telephone' => $utilisateur->telephone,
                'role' => $utilisateur->role,
                'statut_blocage' => $utilisateur->statut_blocage,
                'statut_connexion' => 'echec',
                'ip_adresse' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('login')->with('bloque', 'Vous n\'êtes pas éligible pour vous connecter en raison d\'une restriction du système. Veuillez contacter la Directrice Générale BIKOUMOU Theresa Dinilie au numéro suivant : 053909481.');
        }

        // Vérifier le wallet
        if ($utilisateur->wallet_adresse && $utilisateur->wallet_adresse !== $wallet) {
            // Enregistrer la tentative échouée (mauvais wallet) dans le journal des connexions
            Connexion::create([
                'utilisateur_id' => $utilisateur->id,
                'nom' => $utilisateur->nom,
                'prenom' => $utilisateur->prenom,
                'email' => $utilisateur->email,
                'telephone' => $utilisateur->telephone,
                'role' => $utilisateur->role,
                'statut_blocage' => $utilisateur->statut_blocage,
                'statut_connexion' => 'echec',
                'ip_adresse' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('login')->with('error', 'Wallet non reconnu pour cet utilisateur.');
        }

        // Enregistrer la connexion réussie
        Connexion::create([
            'utilisateur_id' => $utilisateur->id,
            'nom' => $utilisateur->nom,
            'prenom' => $utilisateur->prenom,
            'email' => $utilisateur->email,
            'telephone' => $utilisateur->telephone,
            'role' => $utilisateur->role,
            'statut_blocage' => $utilisateur->statut_blocage,
            'statut_connexion' => 'succes',
            'ip_adresse' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Stocker en session
        session([
            'utilisateur_id' => $utilisateur->id,
            'utilisateur_nom' => $utilisateur->nom,
            'utilisateur_prenom' => $utilisateur->prenom,
            'utilisateur_email' => $utilisateur->email,
            'utilisateur_telephone' => $utilisateur->telephone,
            'utilisateur_role' => $utilisateur->role,
        ]);

        // Rediriger selon le rôle
        switch ($utilisateur->role) {
            case 'directrice_generale':
                return redirect()->route('admin.dashboard');
            case 'chauffeur':
                return redirect()->route('chauffeur.dashboard');
            case 'garagiste':
                return redirect()->route('garagiste.dashboard');
            case 'auditeur':
                return redirect()->route('auditeur.timeline');
            default:
                return redirect()->route('login');
        }
    }

    /**
     * Affiche l'historique des connexions (réservé à la Directrice Générale)
     */
    public function historique()
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $connexions = Connexion::orderBy('created_at', 'desc')->paginate(20);
        $stats = [
            'total' => Connexion::count(),
            'aujourdhui' => Connexion::whereDate('created_at', today())->count(),
            'bloques' => Utilisateur::where('statut_blocage', 'bloque')->count(),
        ];

        return view('admin.historique-connexions', compact('connexions', 'stats'));
    }

    /**
     * Bloque un utilisateur
     */
    public function bloquer($id)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->update(['statut_blocage' => 'bloque']);

        return redirect()->route('admin.historique')->with('success', "L'utilisateur {$utilisateur->nom} a été bloqué avec succès.");
    }

    /**
     * Débloque un utilisateur
     */
    public function debloquer($id)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->update(['statut_blocage' => 'actif']);

        return redirect()->route('admin.historique')->with('success', "L'utilisateur {$utilisateur->nom} a été débloqué avec succès.");
    }

    /**
     * Crée un nouvel utilisateur (réservé à la Directrice Générale)
     */
    public function creerUtilisateur(Request $request)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'telephone' => 'nullable|string|max:20',
            'wallet_adresse' => 'required|string|max:255',
            'role' => 'required|in:directrice_generale,chauffeur,garagiste,auditeur',
        ]);

        $utilisateur = Utilisateur::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'] ?? '',
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? '',
            'wallet_adresse' => $validated['wallet_adresse'],
            'role' => $validated['role'],
            'statut_blocage' => 'actif',
        ]);

        return redirect()->route('admin.parametres')->with('success', "Utilisateur {$utilisateur->prenom} {$utilisateur->nom} créé avec succès !");
    }

    /**
     * Liste des utilisateurs (pour la page paramètres)
     */
    public function listeUtilisateurs()
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $utilisateurs = Utilisateur::orderBy('created_at', 'desc')->get();

        return view('admin.settings', compact('utilisateurs'));
    }
}

