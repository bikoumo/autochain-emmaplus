<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['vin' => '1HGCR2F83HA000001', 'marque' => 'Toyota', 'modele' => 'RAV4', 'proprietaire_adresse' => '0x5B3...edDC4', 'kilometrage' => 45200, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000002', 'marque' => 'Toyota', 'modele' => 'Corolla', 'proprietaire_adresse' => '0x7A2...11BB5', 'kilometrage' => 32100, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000003', 'marque' => 'Honda', 'modele' => 'Civic', 'proprietaire_adresse' => '0x9C1...44CC6', 'kilometrage' => 28700, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000004', 'marque' => 'Hyundai', 'modele' => 'Tucson', 'proprietaire_adresse' => '0x3D8...77DD7', 'kilometrage' => 56100, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000005', 'marque' => 'Mercedes', 'modele' => 'Classe C', 'proprietaire_adresse' => '0xE2F...88EE8', 'kilometrage' => 41200, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000006', 'marque' => 'BMW', 'modele' => 'Serie 3', 'proprietaire_adresse' => '0x4B9...99FF9', 'kilometrage' => 38900, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000007', 'marque' => 'Renault', 'modele' => 'Clio V', 'proprietaire_adresse' => '0x1A2...00GG0', 'kilometrage' => 18500, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000008', 'marque' => 'Peugeot', 'modele' => '3008', 'proprietaire_adresse' => '0x6C3...11HH1', 'kilometrage' => 63400, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000009', 'marque' => 'Volkswagen', 'modele' => 'Golf 8', 'proprietaire_adresse' => '0x8D4...22II2', 'kilometrage' => 27300, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000010', 'marque' => 'Audi', 'modele' => 'A3', 'proprietaire_adresse' => '0x2E5...33JJ3', 'kilometrage' => 52100, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000011', 'marque' => 'Nissan', 'modele' => 'Qashqai', 'proprietaire_adresse' => '0x5F6...44KK4', 'kilometrage' => 44800, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000012', 'marque' => 'Ford', 'modele' => 'Focus', 'proprietaire_adresse' => '0x7G7...55LL5', 'kilometrage' => 35600, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000013', 'marque' => 'Kia', 'modele' => 'Sportage', 'proprietaire_adresse' => '0x9H8...66MM6', 'kilometrage' => 29400, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
            ['vin' => '1HGCR2F83HA000014', 'marque' => 'Tesla', 'modele' => 'Model 3', 'proprietaire_adresse' => '0x0I9...77NN7', 'kilometrage' => 15200, 'contract_address' => '0xd9145CCE52D386f254917e481eB44e9943F39138'],
        ];

        foreach ($vehicles as $v) {
            Vehicle::firstOrCreate(['vin' => $v['vin']], $v);
        }

        $this->command->info('14 véhicules fictifs ajoutés avec succès.');
    }
}

