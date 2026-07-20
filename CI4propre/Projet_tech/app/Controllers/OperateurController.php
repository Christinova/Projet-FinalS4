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
    }public function ajouter()
{
    $clientModel = new ClientModel();
    $transactionModel = new TransactionModel();
    $fraisModel = new FraisModel();

    $numero = $this->request->getPost('prefixe') 
            . $this->request->getPost('numero');

    $montant = $this->request->getPost('montant');
    $type = $this->request->getPost('type_transaction');

    // récupération opérateur
    $idOperateur = $this->request->getPost('id_operateur');


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


    // Insertion transaction
    $transactionModel->insert([
        'id_client' => $idClient,
        'id_operateur' => $idOperateur,
        'id_frais' => $idFrais,
        'montant' => $montant,
        'type_transaction' => $type
    ]);


    return redirect()->to('/historique');
}
   
}
