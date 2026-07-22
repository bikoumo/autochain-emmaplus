<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connexion extends Model
{
    use HasFactory;

    protected $table = 'connexions';

    protected $fillable = [
        'utilisateur_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'role',
        'statut_blocage',
        'statut_connexion',
        'ip_adresse',
        'user_agent',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}

