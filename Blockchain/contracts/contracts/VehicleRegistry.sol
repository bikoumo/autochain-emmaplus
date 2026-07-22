// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

/**
 * @title VehicleRegistry
 * @dev Enregistrement immuable des preuves d'entretien et kilométrage
 */
contract VehicleRegistry {
    
    // Mapping : VIN -> Liste de hashs d'entretien (Preuve d'intégrité)
    mapping(string => bytes32[]) public maintenanceHashes;
    
    // Mapping : VIN -> Kilométrage certifié
    mapping(string => uint256) public certifiedMileage;

    // Événement pour notifier le backend Django qu'une mise à jour a eu lieu
    event RecordUpdated(string vin, string operationType);

    // Fonction pour enregistrer une preuve d'entretien (le hash du PDF par ex.)
    function recordMaintenance(string memory vin, bytes32 _hash) public {
        maintenanceHashes[vin].push(_hash);
        emit RecordUpdated(vin, "MAINTENANCE");
    }

    // Fonction pour mettre à jour le kilométrage certifié
    function updateMileage(string memory vin, uint256 mileage) public {
        certifiedMileage[vin] = mileage;
        emit RecordUpdated(vin, "MILEAGE_UPDATE");
    }
}