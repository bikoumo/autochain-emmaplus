<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'wallet_adresse',
        'role',
        'statut_blocage',
    ];

    public function connexions()
    {
        return $this->hasMany(Connexion::class, 'utilisateur_id');
    }

    public function isBlocked(): bool
    {
        return $this->statut_blocage === 'bloque';
    }

    public function isDirectriceGenerale(): bool
    {
        return $this->role === 'directrice_generale';
    }
}

