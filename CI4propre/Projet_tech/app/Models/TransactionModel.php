<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';

    protected $allowedFields = [
        'id_client',
        'id_operateur',
        'id_frais',
        'montant',
        'type_transaction',
        'pourcentage_commission',
        'numero_destinataire',
        'date_transaction'
    ];

    public function getTransactions()
    {
        return $this->select("
                transaction.*,
                client.nom,
                client.numero,
                operateur.nom AS operateur,
                frais.frais
            ")
            ->join('client', 'client.id_client = transaction.id_client')
            ->join('operateur', 'operateur.id_operateur = transaction.id_operateur')
            ->join('frais', 'frais.id_frais = transaction.id_frais')
            ->findAll();
    }

    public function getHistoriqueClient($idClient)
    {
        return $this->select("
                transaction.*,
                client.nom,
                client.numero,
                operateur.nom AS operateur,
                frais.frais
            ")
            ->join('client', 'client.id_client = transaction.id_client')
            ->join('operateur', 'operateur.id_operateur = transaction.id_operateur')
            ->join('frais', 'frais.id_frais = transaction.id_frais')
            ->where('transaction.id_client', $idClient)
            ->orderBy('transaction.date_transaction', 'DESC')
            ->findAll();
    }

    public function getSituationOperateur($idOperateur)
    {
        return $this->select("
                transaction.*,
                client.nom,
                client.numero,
                operateur.nom AS operateur,
                frais.frais
            ")
            ->join('client', 'client.id_client = transaction.id_client')
            ->join('operateur', 'operateur.id_operateur = transaction.id_operateur')
            ->join('frais', 'frais.id_frais = transaction.id_frais')
            ->where('transaction.id_operateur', $idOperateur)
            ->findAll();
    }

    public function totalFrais($idOperateur)
    {
        return $this->selectSum('frais.frais', 'total')
            ->join('frais', 'frais.id_frais = transaction.id_frais')
            ->where('transaction.id_operateur', $idOperateur)
            ->first();
    }

    public function totalCommission($idOperateur)
    {
        return $this->selectSum('pourcentage_commission', 'total')
            ->where('transaction.id_operateur', $idOperateur)
            ->first();
    }

   public function totalMontant($idOperateur)
{
    return $this->selectSum('transaction.montant', 'total')
        ->where('transaction.id_operateur', $idOperateur)
        ->first();
}
    
}