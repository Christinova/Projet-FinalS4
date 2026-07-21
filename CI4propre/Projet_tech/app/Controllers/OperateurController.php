<?php

namespace App\Controllers;

use App\Models\OperateurModel;
use App\Models\TransactionModel;
use App\Models\ClientModel;
use App\Models\FraisModel;

class OperateurController extends BaseController
{
    public function index()
    {
        $operateurModel = new OperateurModel();
        $transactionModel = new TransactionModel();
        $clientModel = new ClientModel();
        $fraisModel = new FraisModel();

        $data['transaction'] = $transactionModel->getTransactions();
        $data['client'] = $clientModel->getClients();
        $data['frais'] = $fraisModel->getFrais();
        $data['operateur'] = $operateurModel->getOperateur();

        return view('operateur/operateur', $data);
    }
    public function ajouter()
{
    $clientModel = new ClientModel();
    $transactionModel = new TransactionModel();
    $fraisModel = new FraisModel();
    $operateurModel = new OperateurModel();

    $numero = $this->request->getPost('prefixe') 
            . $this->request->getPost('numero');

    $montant = $this->request->getPost('montant');
    $type = $this->request->getPost('type_transaction');

    // récupération opérateur
    $idOperateur = $this->request->getPost('id_operateur');
$operateur = $operateurModel->find($idOperateur);

if (!$operateur) {
    return redirect()->back()
        ->with('error', 'Opérateur introuvable');
}

    // Recherche ou création du client
    $client = $clientModel
        ->where('numero', $numero)
        ->first();


    if (!$client) {

        $clientModel->insert([
            'nom' => 'Client',
            'numero' => $numero
        ]);

        $idClient = $clientModel->insertID();

    } else {

        $idClient = $client['id_client'];

    }


    // Recherche du frais correspondant au montant
    $frais = $fraisModel
        ->where('montant_min <=', $montant)
        ->where('montant_max >=', $montant)
        ->first();


    if (!$frais) {
        return redirect()->back()
            ->with('error','Aucun frais trouvé pour ce montant');
    }

$idFrais = $frais['id_frais'];

$fraistransaction = (float) $frais['frais'];
$commission = (float) $operateur['pourcentage_commission'];

$pourcentage_commission = ($fraistransaction * $commission) / 100;

    // Insertion transaction
   $transactionModel->insert([
    'id_client' => $idClient,
    'id_operateur' => $idOperateur,
    'id_frais' => $idFrais,
    'montant' => $montant,
    'type_transaction' => $type,
    'pourcentage_commission' => $pourcentage_commission
]);


    return redirect()->to('/historique');
}
   
}
