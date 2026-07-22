import json

# 1. Configuration du nœud
RPC_URL = 'http://127.0.0.1:8545'

# 2. Adresses des contrats (Copie-les depuis la zone 'Deployed Contracts' dans Remix)
ACCESS_CONTROL_ADDRESS = "0xd8b934580fcE35a11B58C6D73aDeE468a2833fa8" 
VEHICLE_REGISTRY_ADDRESS = "0xd9145CCE52D386f254917e481eB44e9943F39138"

# 3. ABI du contrat AccessControl
_ACCESS_CONTROL_ABI = """
[
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_mechanic",
				"type": "address"
			}
		],
		"name": "addMechanic",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "admin",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "authorizedMechanics",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_mechanic",
				"type": "address"
			}
		],
		"name": "removeMechanic",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	}
] 
"""
ACCESS_CONTROL_ABI = json.loads(_ACCESS_CONTROL_ABI)

# 4. ABI du contrat VehicleRegistry
_VEHICLE_REGISTRY_ABI = """
[ 
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "vin",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "operationType",
				"type": "string"
			}
		],
		"name": "RecordUpdated",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"name": "certifiedMileage",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "maintenanceHashes",
		"outputs": [
			{
				"internalType": "bytes32",
				"name": "",
				"type": "bytes32"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "vin",
				"type": "string"
			},
			{
				"internalType": "bytes32",
				"name": "_hash",
				"type": "bytes32"
			}
		],
		"name": "recordMaintenance",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "vin",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "mileage",
				"type": "uint256"
			}
		],
		"name": "updateMileage",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	}
] 
"""
VEHICLE_REGISTRY_ABI = json.loads(_VEHICLE_REGISTRY_ABI)