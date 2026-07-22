<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chauffeur;

class ChauffeurController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Chauffeur::query();
        if ($filter === 'mission') {
            $query->where('statut', 'mission');
        } elseif ($filter === 'inactive') {
            $query->where('statut', 'inactif');
        } elseif ($filter === 'active') {
            $query->where('statut', 'disponible');
        }

        $chauffeurs = $query->get();
        $total = Chauffeur::count();
        $enMission = Chauffeur::where('statut', 'mission')->count();
        $inactifs = Chauffeur::where('statut', 'inactif')->count();

        if ($request->wantsJson()) {
            return response()->json([
                'chauffeurs' => $chauffeurs,
                'stats' => [
                    'total' => $total,
                    'mission' => $enMission,
                    'inactive' => $inactifs,
                ]
            ]);
        }

        return view('admin.chauffeurs', compact('chauffeurs', 'filter', 'total', 'enMission', 'inactifs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:chauffeurs,email',
            'statut' => 'required|in:disponible,mission,inactif',
            'vehicule_attitre' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'derniere_mission' => 'nullable|date',
        ]);

        $chauffeur = Chauffeur::create($validated);

        // Recalculer les stats
        $total = Chauffeur::count();
        $enMission = Chauffeur::where('statut', 'mission')->count();
        $inactifs = Chauffeur::where('statut', 'inactif')->count();

        return response()->json([
            'success' => true,
            'chauffeur' => $chauffeur,
            'stats' => [
                'total' => $total,
                'mission' => $enMission,
                'inactive' => $inactifs,
            ]
        ]);
    }
}

