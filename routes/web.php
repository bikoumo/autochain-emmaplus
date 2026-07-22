<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FactureController;

// Page de Connexion
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Authentification - remplace l'ancien système à sélecteur de rôle
Route::post('/login', [ConnexionController::class, 'login'])->name('login.submit');

// Déconnexion
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

// Guide de l'Application (dynamique selon le rôle)
Route::get('/guide', function () {
    if (!session('utilisateur_id')) return redirect()->route('login');
    $role = session('utilisateur_role', 'visiteur');
    return view('guide.index', ['role' => $role]);
})->name('guide');

// Demande d'accès (public - quand un utilisateur n'a pas de compte)
Route::post('/demande-acces', [App\Http\Controllers\DemandeController::class, 'soumettre'])->name('demande.acces');

// Page de Profil
Route::get('/profil', function () {
    if (!session('utilisateur_id')) return redirect()->route('login');
    return view('profil.index');
})->name('profil');

// --- ESPACE DIRECTRICE GÉNÉRALE (admin) ---
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Gestion du Parc
    Route::get('/parc', [VehicleController::class, 'index'])->name('admin.parc');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Pages des cartes cliquables du Dashboard
    Route::get('/vehicules/tous', function () {
        return view('admin.filtered', ['filter' => 'tous', 'title' => 'Liste de tous les Véhicules']);
    })->name('admin.vehicles.all');

    Route::get('/vehicules/mission', function () {
        return view('admin.filtered', ['filter' => 'mission', 'title' => 'Véhicules Actuellement en Mission']);
    })->name('admin.vehicles.mission');

    Route::get('/vehicules/disponibles', function () {
        return view('admin.filtered', ['filter' => 'disponible', 'title' => 'Véhicules Disponibles dans le Parc']);
    })->name('admin.vehicles.available');

    Route::get('/vehicules/alertes', function () {
        return view('admin.filtered', ['filter' => 'alerte', 'title' => 'Véhicules sous Alerte Maintenance']);
    })->name('admin.vehicles.alerts');

    // Sidebar - Routes Administrateur
    Route::get('/chauffeurs', [ChauffeurController::class, 'index'])->name('admin.chauffeurs');
    Route::post('/chauffeurs', [ChauffeurController::class, 'store'])->name('admin.chauffeurs.store');

    Route::get('/garages', function (Request $request) {
        $filter = $request->query('filter', 'all');
        return view('admin.garages', ['filter' => $filter]);
    })->name('admin.garages');

    Route::get('/contracts', function () { return view('admin.contracts'); })->name('admin.contracts');
    Route::get('/parametres', [ConnexionController::class, 'listeUtilisateurs'])->name('admin.parametres');
    Route::post('/utilisateurs/creer', [ConnexionController::class, 'creerUtilisateur'])->name('admin.utilisateurs.creer');

    // Demandes d'accès (messagerie DG)
    Route::get('/demandes', [DemandeController::class, 'index'])->name('admin.demandes');
    Route::post('/demandes/{id}/valider', [DemandeController::class, 'valider'])->name('admin.demandes.valider');
    Route::post('/demandes/{id}/refuser', [DemandeController::class, 'refuser'])->name('admin.demandes.refuser');

    // Historique des Connexions (DG only)
    Route::get('/historique-connexions', [ConnexionController::class, 'historique'])->name('admin.historique');
    Route::post('/utilisateurs/{id}/bloquer', [ConnexionController::class, 'bloquer'])->name('admin.utilisateurs.bloquer');
    Route::post('/utilisateurs/{id}/debloquer', [ConnexionController::class, 'debloquer'])->name('admin.utilisateurs.debloquer');

    // Facturation
    Route::get('/factures', [FactureController::class, 'index'])->name('admin.factures');
    Route::post('/factures', [FactureController::class, 'store'])->name('factures.store');
    Route::get('/factures/{id}/pdf', [FactureController::class, 'generatePdf'])->name('factures.pdf');
});

// Espaces autres rôles (avec vérification session)
Route::get('/chauffeur/dashboard', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'chauffeur') return redirect()->route('login');
    return view('chauffeur.dashboard');
})->name('chauffeur.dashboard');

Route::get('/chauffeur/trajets', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'chauffeur') return redirect()->route('login');
    return view('chauffeur.trajets');
})->name('chauffeur.trajets');

Route::get('/chauffeur/vehicule', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'chauffeur') return redirect()->route('login');
    return view('chauffeur.vehicule');
})->name('chauffeur.vehicule');

Route::get('/garagiste/dashboard', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'garagiste') return redirect()->route('login');
    return view('garagiste.dashboard');
})->name('garagiste.dashboard');

Route::get('/garagiste/interventions', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'garagiste') return redirect()->route('login');
    return view('garagiste.interventions');
})->name('garagiste.interventions');

Route::get('/garagiste/certifications', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'garagiste') return redirect()->route('login');
    return view('garagiste.certifications');
})->name('garagiste.certifications');

Route::get('/auditeur/timeline', function () {
    if (!session('utilisateur_id') || session('utilisateur_role') !== 'auditeur') return redirect()->route('login');
    return view('auditeur.timeline');
})->name('auditeur.timeline');
