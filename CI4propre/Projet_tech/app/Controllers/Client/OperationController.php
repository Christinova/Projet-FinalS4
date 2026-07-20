<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\FraisModel;
use App\Models\TransactionModel;

class OperationController extends BaseController
{
    
    public function depot()
    {
        return view('client/depot');
    }

    public function depotAction()
    {
        $montant = (float) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Montant invalide.');
        }

        $fraisModel = new FraisModel();
        $frais      = $fraisModel->findByMontant($montant);

        if (! $frais) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Aucun frais trouvé pour ce montant.');
        }

        $transactionModel = new TransactionModel();

        $transactionModel->insert([
            'id_client'        => session('id_client'),
            'id_operateur'     => session('id_operateur'),
            'id_frais'         => $frais['id_frais'],
            'montant'          => $montant,
            'type_transaction' => 'depot',
        ]);

        return redirect()->to('/client')
            ->with('success', 'Dépôt de ' . $montant . ' Ar effectué.');
    }

  
    public function retrait()
    {
        return view('client/retrait');
    }

    public function retraitAction()
    {
        $montant     = (float) $this->request->getPost('montant');
        $fraisInclus = $this->request->getPost('payer_frais') ? 1 : 0;

        if ($montant <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Montant invalide.');
        }

        $fraisModel = new FraisModel();
        $frais      = $fraisModel->findByMontant($montant);

        if (! $frais) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Aucun frais trouvé pour ce montant.');
        }

        $transactionModel = new TransactionModel();
        $idClient          = session('id_client');
        $solde              = $transactionModel->getSoldeClient($idClient);
        $totalADebiter      = $montant + ($fraisInclus ? (float) $frais['frais'] : 0);

        if ($totalADebiter > $solde) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Solde insuffisant pour effectuer ce retrait (montant' . ($fraisInclus ? ' + frais' : '') . ' = ' . $totalADebiter . ' Ar, solde = ' . $solde . ' Ar).');
        }

        $transactionModel->insert([
            'id_client'        => $idClient,
            'id_operateur'     => session('id_operateur'),
            'id_frais'         => $frais['id_frais'],
            'montant'          => $montant,
            'type_transaction' => 'retrait',
            'frais_inclus'     => $fraisInclus,
        ]);

        return redirect()->to('/client')
            ->with('success', 'Retrait de ' . $montant . ' Ar effectué.');
    }

   
    public function transfert()
    {
        return view('client/transfert');
    }

    public function transfertAction()
{
    $montant = (float) $this->request->getPost('montant');

    if ($montant <= 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Montant invalide.');
    }

    $liste = $this->request->getPost('numeros');

    $liste = array_filter(array_map('trim', $liste));

    $liste = array_filter(array_map('trim', $liste));

    if (count($liste) == 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Veuillez saisir au moins un numéro.');
    }

    // Vérification : pas de transfert vers soi-même
    foreach ($liste as $numero) {

        if ($numero == session('numero')) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Vous ne pouvez pas vous transférer de l\'argent.');
        }

    }

    $nb = count($liste);

    // Répartition du montant
    $montantParNumero = floor($montant / $nb);
    $reste = $montant - ($montantParNumero * $nb);

    $fraisModel = new FraisModel();
    $frais = $fraisModel->findByMontant($montant);

    if (!$frais) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Aucun frais trouvé.');
    }

    $transactionModel = new TransactionModel();

    $idClient = session('id_client');

    $solde = $transactionModel->getSoldeClient($idClient);

    $totalADebiter = $montant + (float)$frais['frais'];

    if ($totalADebiter > $solde) {

        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                'Solde insuffisant.'
            );
    }

    foreach ($liste as $index => $numero) {

        $montantEnvoye = $montantParNumero;

        if ($reste > 0) {
            $montantEnvoye++;
            $reste--;
        }

        $transactionModel->insert([
            'id_client' => $idClient,
            'id_operateur' => session('id_operateur'),
            'id_frais' => $frais['id_frais'],
            'montant' => $montantEnvoye,
            'type_transaction' => 'transfert',
            'numero_destinataire' => $numero,
        ]);

    }

    return redirect()->to('/client')
        ->with(
            'success',
            'Transfert effectué vers ' . $nb . ' destinataire(s).'
        );
}
}