<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'vin',
        'marque',
        'modele',
        'proprietaire_adresse',
        'kilometrage',
        'contract_address',
    ];
}