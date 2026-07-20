<?php

namespace App\Controllers;

use App\Models\OperateurModel;

class OperateurController extends BaseController
{
    public function index()
    {
        $model = new OperateurModel();

        $data['transactions'] = $model->getTransactions();

        return view('operateur/operateur', $data);
    }
}