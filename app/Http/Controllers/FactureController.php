<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Vehicle;

class FactureController extends Controller
{
    public function index()
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $factures = Facture::with('vehicule')->orderBy('created_at', 'desc')->paginate(10);
        $vehicules = Vehicle::all();

        return view('factures.index', compact('factures', 'vehicules'));
    }

    public function store(Request $request)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'acheteur_nom' => 'required|string|max:255',
            'acheteur_email' => 'required|email',
            'acheteur_telephone' => 'nullable|string|max:20',
            'vehicule_id' => 'required|exists:vehicles,id',
            'type_vehicule' => 'required|in:neuf,occasion',
            'mode_paiement' => 'required|in:cash,tranches',
            'montant_total' => 'required|numeric|min:0',
            'premiere_tranche' => 'nullable|required_if:mode_paiement,tranches|numeric|min:0',
            'echeancier' => 'nullable|string',
        ]);

        $facture = Facture::create($validated);

        return redirect()->route('admin.factures')->with('success', 'Facture créée avec succès.');
    }

    public function generatePdf($id)
    {
        if (session('utilisateur_role') !== 'directrice_generale') {
            return redirect()->route('login');
        }

        $facture = Facture::with('vehicule')->findOrFail($id);

        // Génération du PDF avec DOMPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('factures.pdf', compact('facture'));

        return $pdf->download("facture_{$facture->id}.pdf");
    }
}

