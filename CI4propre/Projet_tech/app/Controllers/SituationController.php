<?php

namespace App\Controllers;

use App\Models\OperateurModel;
use App\Models\TransactionModel;

class SituationController extends BaseController
{
    public function index()
    {
        $operateurModel = new OperateurModel();
        $transactionModel = new TransactionModel();

        $data['operateur'] = $operateurModel->findAll();

        $idOperateur = $this->request->getGet('id_operateur');

        if ($idOperateur) {

            $data['transactions'] = $transactionModel->getSituationOperateur($idOperateur);

            $data['totalFrais'] = $transactionModel->totalFrais($idOperateur);

            $data['totalCommission'] = $transactionModel->totalCommission($idOperateur);

        } else {

            $data['transactions'] = [];
            $data['totalFrais'] = ['total' => 0];
            $data['totalCommission'] = ['total' => 0];
        }

        return view('operateur/situation', $data);
    }
}