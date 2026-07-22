// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

/**
 * @title AccessControl
 * @dev Gère les autorisations pour le réseau AutoChain Emma+
 */
contract AccessControl {
    address public admin;
    // Liste blanche des adresses autorisées à effectuer des certifications
    mapping(address => bool) public authorizedMechanics;

    constructor() {
        admin = msg.sender;
    }

    // Modificateur pour restreindre l'accès à l'administrateur
    modifier onlyAdmin() {
        require(msg.sender == admin, "Acces refuse : seul l'admin peut effectuer cette action");
        _;
    }

    // Fonction pour ajouter un garagiste agréé
    function addMechanic(address _mechanic) public onlyAdmin {
        authorizedMechanics[_mechanic] = true;
    }

    // Fonction pour révoquer un garagiste
    function removeMechanic(address _mechanic) public onlyAdmin {
        authorizedMechanics[_mechanic] = false;
    }
}