<?php

namespace App\Models;
use CodeIgniter\Model;

class FraisModel extends Model
{
    protected $table = 'frais';
    protected $primaryKey = 'id_frais';

    protected $allowedFields = [
        'id_frais',
        'montant_min',
        'montant_max',
        'frais'
    ];

    public function getFrais()
    {
        return $this->findAll();
    }

    
    public function findByMontant(float $montant)
    {
        return $this->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->first();
    }
}