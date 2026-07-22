<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création du compte Directrice Générale par défaut
        Utilisateur::firstOrCreate(
            ['email' => 'bikoumoutheresa@gmail.com'],
            [
                'nom' => 'BIKOUMOU Theresa Dinilie',
                'prenom' => 'Theresa',
                'email' => 'bikoumoutheresa@gmail.com',
                'telephone' => '053909481',
                'wallet_adresse' => '0xd9145CCE52D386f254917e481eB44e9943F39138',
                'role' => 'directrice_generale',
                'statut_blocage' => 'actif',
            ]
        );

        $this->call([
            ChauffeurSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}