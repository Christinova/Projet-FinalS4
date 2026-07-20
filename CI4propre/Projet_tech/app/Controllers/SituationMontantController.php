<?php
namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\OperateurModel;

class SituationMontantController extends BaseController
{
    public function index()
    {
        $operateurModel = new OperateurModel();
        $transactionModel = new TransactionModel();

        $data['operateur'] = $operateurModel->findAll();

        $idOperateur = $this->request->getGet('id_operateur');

        if ($idOperateur) {

            $data['transactions'] = $transactionModel->getSituationOperateur($idOperateur);

            $data['totalMontant'] = $transactionModel->totalMontant($idOperateur);

        } else {

            $data['transactions'] = [];
            $data['totalMontant'] = ['total' => 0];
        }

        return view('operateur/situation_montant', $data);
    }
}