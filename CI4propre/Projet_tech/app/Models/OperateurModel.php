<?php

namespace App\Models;
use CodeIgniter\Model;

class OperateurModel extends Model
{
    protected $table = 'operateur';
    protected $primaryKey = 'id_operateur';

    protected $allowedFields = [
        'nom',
        'prefixe'
    ];

    public function getOperateur(){
        return $this->findAll();
    }

    
    public function findByPrefixe(string $prefixe)
    {
        return $this->where('prefixe', $prefixe)->first();
    }
}