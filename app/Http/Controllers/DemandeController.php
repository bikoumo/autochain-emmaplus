<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connexion;
use App\Models\Demande;

class DemandeController extends Controller
{
    /**
     * Affiche la liste des demandes (réservé à la Directrice Générale)
     */
    public function index()
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $demandes = Demande::orderBy('created_at', 'desc')->get();

        // Récupérer les tentatives de connexion échouées
        $tentativesEchouees = Connexion::where('statut_connexion', 'échec')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => Demande::count(),
            'en_attente' => Demande::where('statut', 'en_attente')->count(),
            'validees' => Demande::where('statut', 'validee')->count(),
            'refusees' => Demande::where('statut', 'refusee')->count(),
            'tentatives_echouees' => Connexion::where('statut_connexion', 'échec')->count(),
        ];

        return view('admin.demandes', compact('demandes', 'tentativesEchouees', 'stats'));
    }

    /**
     * Enregistre une demande d'accès depuis la page de connexion
     */
    public function soumettre(Request $request)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:1000',
        ]);

        $demande = Demande::create([
            'nom' => $request->nom ?? 'Non renseigné',
            'prenom' => $request->prenom ?? '',
            'email' => $request->email,
            'telephone' => $request->telephone ?? '',
            'wallet_saisi' => $request->wallet ?? '',
            'role_souhaite' => $request->role_souhaite ?? 'non précisé',
            'statut' => 'en_attente',
            'message' => $request->message ?? '',
            'ip_adresse' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('login')->with('demande_envoyee', 'Votre demande d\'accès a été transmise à la Directrice Générale. Vous serez notifié(e) dès que votre compte sera créé. Veuillez contacter la Directrice Générale BIKOUMOU Theresa Dinilie au 053909481 pour plus d\'informations.');
    }

    /**
     * Valide une demande (DG crée l'utilisateur depuis l'interface)
     */
    public function valider($id)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $demande = Demande::findOrFail($id);
        $demande->update(['statut' => 'validee']);

        return redirect()->route('admin.demandes')->with('success', "Demande de {$demande->prenom} {$demande->nom} marquée comme validée. Créez son compte dans Paramètres.");
    }

    /**
     * Refuse une demande
     */
    public function refuser($id)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $demande = Demande::findOrFail($id);
        $demande->update(['statut' => 'refusee']);

        return redirect()->route('admin.demandes')->with('success', "Demande de {$demande->prenom} {$demande->nom} refusée.");
    }
}

