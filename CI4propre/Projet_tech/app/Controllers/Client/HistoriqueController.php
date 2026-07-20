<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class HistoriqueController extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();

        $data['transactions'] = $transactionModel->getHistoriqueClient(session('id_client'));

        return view('client/historique', $data);
    }
}
