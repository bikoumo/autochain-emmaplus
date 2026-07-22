<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'wallet_saisi',
        'role_souhaite',
        'statut',
        'message',
        'ip_adresse',
        'user_agent',
    ];

    protected $casts = [
        'statut' => 'string',
    ];

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
}

