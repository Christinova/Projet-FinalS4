<?php

namespace App\Models;

use CodeIgniter\Model;

class OperateurModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';

    protected $allowedFields = [
        'id_client',
        'montant',
        'type_transaction',
        'date_transaction'
    ];

    public function getTransactions()
    {
        return $this->findAll();
    }
}