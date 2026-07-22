//importer la version
const { version } = require("react");
const crypto = required('crypto');
//CREATION DE LA FONCTION
function creatblock(PrecedentHash, transactions){
//CREATION DU BLOCK
    const headerblock={
        version:1,
        timestamp:Date.now(),
        PrecedentHash:PrecedentHash,
        timestamp:Date .now(),
        nonce:0,
        }
//CALCULER LE HASH DU BLOCK
        constHeader=crypto.creathash('Sha256').update(JSON.stringify(headerblock)).digest('hex');
        const block={
            headerblock,
            transactions:transactions,
            Headers:Headers
        }
        return block;
  }
  // CREATION DU TABLEAU DE TRANSACTIONS
  const hblock=creatblock("0000,['T1:A->B,T2:C->D,T3:E->F']")
  console.log(hblock);

