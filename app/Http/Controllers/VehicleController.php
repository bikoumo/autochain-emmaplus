<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle; // Assure-toi d'avoir ton modèle Vehicle

class VehicleController extends Controller
{
    // Affiche la liste du parc et le formulaire
    public function index()
    {
        // Récupère tous les véhicules enregistrés
        $vehicles = Vehicle::all(); 

        return view('admin.parc', compact('vehicles'));
    }

    // Enregistrement d'un nouveau véhicule (sécurisé — pas d'erreur 500)
    public function store(Request $request)
    {
        try {
            $request->validate([
                'vin' => 'required|string|max:17',
                'marque' => 'required|string',
                'modele' => 'required|string',
                'proprietaire_adresse' => 'required|string|max:42',
                'kilometrage' => 'required|integer',
            ]);

            Vehicle::create([
                'vin' => $request->vin,
                'marque' => $request->marque,
                'modele' => $request->modele,
                'proprietaire_adresse' => $request->proprietaire_adresse,
                'kilometrage' => $request->kilometrage,
                'contract_address' => $request->contract_address ?? '0xd9145CCE52D386f254917e481eB44e9943F39138'
            ]);

            return redirect()->route('admin.parc')->with('success', 'Véhicule enregistré avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('admin.parc')->with('warning', 'Action en cours de finalisation ou module temporairement indisponible. Le véhicule n\'a pas pu être enregistré pour le moment. Veuillez réessayer ou contacter la Directrice Générale.');
        }
    }

    // Affiche le formulaire d'édition d'un véhicule (JSON)
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return response()->json($vehicle);
    }

    // Mise à jour d'un véhicule
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'vin' => 'required|string|max:17',
            'marque' => 'required|string',
            'modele' => 'required|string',
            'proprietaire_adresse' => 'required|string|max:42',
            'kilometrage' => 'required|integer',
        ]);

        $vehicle->update([
            'vin' => $request->vin,
            'marque' => $request->marque,
            'modele' => $request->modele,
            'proprietaire_adresse' => $request->proprietaire_adresse,
            'kilometrage' => $request->kilometrage,
        ]);

        return redirect()->route('admin.parc')->with('success', 'Véhicule mis à jour avec succès !');
    }

    // Suppression d'un véhicule
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('admin.parc')->with('success', 'Véhicule supprimé avec succès !');
    }
}
