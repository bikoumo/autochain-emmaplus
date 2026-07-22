<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chauffeur;

class ChauffeurSeeder extends Seeder
{
    public function run(): void
    {
        $chauffeurs = [
            // 18 chauffeurs en mission
            ['nom' => 'Jean Dupont', 'email' => 'jean.dupont@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Toyota RAV4 (VIN: 1HGCR...)', 'derniere_mission' => '2026-06-15'],
            ['nom' => 'Alex Durand', 'email' => 'alex.durand@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Hyundai Tucson', 'derniere_mission' => '2026-06-14'],
            ['nom' => 'Marc Roussel', 'email' => 'marc.roussel@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Peugeot 3008', 'derniere_mission' => '2026-06-13'],
            ['nom' => 'Sophie Lambert', 'email' => 'sophie.lambert@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Renault Clio', 'derniere_mission' => '2026-06-12'],
            ['nom' => 'Lucas Moreau', 'email' => 'lucas.moreau@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Citroën C5', 'derniere_mission' => '2026-06-11'],
            ['nom' => 'Emma Petit', 'email' => 'emma.petit@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Ford Focus', 'derniere_mission' => '2026-06-10'],
            ['nom' => 'Hugo Bernard', 'email' => 'hugo.bernard@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'BMW Serie 3', 'derniere_mission' => '2026-06-09'],
            ['nom' => 'Julie Robert', 'email' => 'julie.robert@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Audi A4', 'derniere_mission' => '2026-06-08'],
            ['nom' => 'Thomas Leroy', 'email' => 'thomas.leroy@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Mercedes Classe C', 'derniere_mission' => '2026-06-07'],
            ['nom' => 'Camille Dubois', 'email' => 'camille.dubois@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Volkswagen Golf', 'derniere_mission' => '2026-06-06'],
            ['nom' => 'Nicolas Fournier', 'email' => 'nicolas.fournier@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Toyota Corolla', 'derniere_mission' => '2026-06-05'],
            ['nom' => 'Marie Girard', 'email' => 'marie.girard@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Honda Civic', 'derniere_mission' => '2026-06-04'],
            ['nom' => 'Antoine Bonnet', 'email' => 'antoine.bonnet@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Peugeot 508', 'derniere_mission' => '2026-06-03'],
            ['nom' => 'Léa Colin', 'email' => 'lea.colin@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Renault Mégane', 'derniere_mission' => '2026-06-02'],
            ['nom' => 'Pierre Gauthier', 'email' => 'pierre.gauthier@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Ford Kuga', 'derniere_mission' => '2026-06-01'],
            ['nom' => 'Manon Perrin', 'email' => 'manon.perrin@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Dacia Duster', 'derniere_mission' => '2026-05-31'],
            ['nom' => 'Romain Chevalier', 'email' => 'romain.chevalier@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Nissan Qashqai', 'derniere_mission' => '2026-05-30'],
            ['nom' => 'Chloé Lefèvre', 'email' => 'chloe.lefevre@autochain.com', 'statut' => 'mission', 'vehicule_attitre' => 'Suzuki Vitara', 'derniere_mission' => '2026-05-29'],

            // 6 chauffeurs inactifs
            ['nom' => 'Paul Lefèvre', 'email' => 'paul.lefevre@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-05-20'],
            ['nom' => 'Claire Bernard', 'email' => 'claire.bernard@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-05-15'],
            ['nom' => 'Julien Mercier', 'email' => 'julien.mercier@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-05-10'],
            ['nom' => 'Anaïs Laurent', 'email' => 'anais.laurent@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-05-05'],
            ['nom' => 'David Rivière', 'email' => 'david.riviere@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-04-28'],
            ['nom' => 'Elodie Fontaine', 'email' => 'elodie.fontaine@autochain.com', 'statut' => 'inactif', 'vehicule_attitre' => null, 'derniere_mission' => '2026-04-20'],
        ];

        foreach ($chauffeurs as $chauffeur) {
            Chauffeur::firstOrCreate(
                ['email' => $chauffeur['email']],
                $chauffeur
            );
        }
    }
}

