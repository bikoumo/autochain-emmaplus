# blockchain/utils.py
from web3 import Web3
from .blockchain_config import (
    RPC_URL, 
    ACCESS_CONTROL_ADDRESS, ACCESS_CONTROL_ABI,
    VEHICLE_REGISTRY_ADDRESS, VEHICLE_REGISTRY_ABI
)

# Initialisation de la connexion
w3 = Web3(Web3.HTTPProvider(RPC_URL))

# Instanciation des contrats
access_contract = w3.eth.contract(address=ACCESS_CONTROL_ADDRESS, abi=ACCESS_CONTROL_ABI)
vehicle_contract = w3.eth.contract(address=VEHICLE_REGISTRY_ADDRESS, abi=VEHICLE_REGISTRY_ABI)

# Exemple de fonction pour vérifier un garagiste
def est_garagiste_autorise(adresse_compte):
    # Appelle la fonction 'authorizedMechanics' du contrat Solidity
    return access_contract.functions.authorizedMechanics(adresse_compte).call()