<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;

    protected $table = 'chauffeurs';

    protected $fillable = [
        'nom',
        'email',
        'statut',
        'vehicule_attitre',
        'derniere_mission',
        'telephone',
    ];

    protected $casts = [
        'derniere_mission' => 'date',
    ];
}

