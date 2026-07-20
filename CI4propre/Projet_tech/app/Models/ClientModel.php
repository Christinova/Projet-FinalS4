<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id_client';

    protected $allowedFields = [
        'id_client',
        'nom',
        'numero'
    ];

    public function getClients()
    {
        return $this->findAll();
    }
}
