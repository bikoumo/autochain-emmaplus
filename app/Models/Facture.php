<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $fillable = [
        'acheteur_nom',
        'acheteur_email',
        'acheteur_telephone',
        'vehicule_id',
        'type_vehicule',
        'mode_paiement',
        'montant_total',
        'premiere_tranche',
        'echeancier',
        'statut',
    ];

    protected $casts = [
        'montant_total' => 'decimal:2',
        'premiere_tranche' => 'decimal:2',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicle::class, 'vehicule_id');
    }
}

