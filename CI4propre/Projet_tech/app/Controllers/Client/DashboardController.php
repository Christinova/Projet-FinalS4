<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class DashboardController extends BaseController
{
    /**
     * Tableau de bord : affiche le solde et le menu des opérations.
     */
    public function index()
    {
        $transactionModel = new TransactionModel();

        $session  = session();
        $idClient = $session->get('id_client');

        $data['nom_client'] = $session->get('nom_client');
        $data['numero']     = $session->get('numero');
        $data['operateur']  = $session->get('operateur');
        $data['solde']      = $transactionModel->getSoldeClient($idClient);

        return view('client/dashboard', $data);
    }
}
