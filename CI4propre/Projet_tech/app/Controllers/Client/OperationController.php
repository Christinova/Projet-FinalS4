<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\FraisModel;
use App\Models\TransactionModel;

class OperationController extends BaseController
{
    // ------------------------------------------------------------------
    // DEPOT
    // ------------------------------------------------------------------

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

        // Dépôt : simple insertion, le client reçoit le montant en entier.
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

    // ------------------------------------------------------------------
    // RETRAIT
    // ------------------------------------------------------------------

    public function retrait()
    {
        return view('client/retrait');
    }

    public function retraitAction()
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
        $idClient          = session('id_client');
        $solde              = $transactionModel->getSoldeClient($idClient);
        $totalADebiter      = $montant + (float) $frais['frais'];

        if ($totalADebiter > $solde) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Solde insuffisant pour effectuer ce retrait (montant + frais = ' . $totalADebiter . ' Ar, solde = ' . $solde . ' Ar).');
        }

        $transactionModel->insert([
            'id_client'        => $idClient,
            'id_operateur'     => session('id_operateur'),
            'id_frais'         => $frais['id_frais'],
            'montant'          => $montant,
            'type_transaction' => 'retrait',
        ]);

        return redirect()->to('/client')
            ->with('success', 'Retrait de ' . $montant . ' Ar effectué.');
    }

    // ------------------------------------------------------------------
    // TRANSFERT
    // ------------------------------------------------------------------

    public function transfert()
    {
        return view('client/transfert');
    }

    public function transfertAction()
    {
        $montant            = (float) $this->request->getPost('montant');
        $numeroDestinataire = trim((string) $this->request->getPost('numero_destinataire'));

        if ($montant <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Montant invalide.');
        }

        if ($numeroDestinataire === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Veuillez saisir le numéro du destinataire.');
        }

        if ($numeroDestinataire === session('numero')) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Vous ne pouvez pas vous transférer de l\'argent à vous-même.');
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
        $totalADebiter      = $montant + (float) $frais['frais'];

        if ($totalADebiter > $solde) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Solde insuffisant pour effectuer ce transfert (montant + frais = ' . $totalADebiter . ' Ar, solde = ' . $solde . ' Ar).');
        }

        // Le transfert est une sortie d'argent : il débite montant + frais
        // chez l'expéditeur, exactement comme un retrait. Aucun compte
        // n'est crédité en face ; le numéro du destinataire est conservé
        // uniquement à titre de trace.
        $transactionModel->insert([
            'id_client'           => $idClient,
            'id_operateur'        => session('id_operateur'),
            'id_frais'            => $frais['id_frais'],
            'montant'             => $montant,
            'type_transaction'    => 'transfert',
            'numero_destinataire' => $numeroDestinataire,
        ]);

        return redirect()->to('/client')
            ->with('success', 'Transfert de ' . $montant . ' Ar vers ' . $numeroDestinataire . ' effectué.');
    }
}
