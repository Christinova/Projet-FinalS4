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
        'numero_destinataire',
        'frais_inclus',
        'date_transaction'
    ];

    public function getTransactions()
    {
        return $this->select(
            'transaction.*,
            client.nom,
            client.numero,
            operateur.nom as operateur,
            frais.frais'
        )
        ->join('client', 'client.id_client = transaction.id_client')
        ->join('operateur', 'operateur.id_operateur = transaction.id_operateur')
        ->join('frais', 'frais.id_frais = transaction.id_frais')
        ->findAll();
    }

    /**
     * Historique des transactions d'un seul client (espace client),
     * du plus récent au plus ancien.
     */
    public function getHistoriqueClient(int $idClient)
    {
        return $this->select(
            'transaction.*,
            client.nom,
            client.numero,
            operateur.nom as operateur,
            frais.frais'
        )
        ->join('client', 'client.id_client = transaction.id_client')
        ->join('operateur', 'operateur.id_operateur = transaction.id_operateur')
        ->join('frais', 'frais.id_frais = transaction.id_frais')
        ->where('transaction.id_client', $idClient)
        ->orderBy('transaction.date_transaction', 'DESC')
        ->findAll();
    }

    public function getSoldeClient(int $idClient): float
    {
        $db = \Config\Database::connect();

        $totalDepot = (float) ($db->table('transaction')
            ->selectSum('montant')
            ->where('id_client', $idClient)
            ->where('type_transaction', 'depot')
            ->get()
            ->getRow('montant') ?? 0);

        $sorties = $db->table('transaction')
            ->select('transaction.montant, transaction.frais_inclus, frais.frais')
            ->join('frais', 'frais.id_frais = transaction.id_frais')
            ->where('transaction.id_client', $idClient)
            ->whereIn('transaction.type_transaction', ['retrait', 'transfert'])
            ->get()
            ->getResultArray();

        $totalSorties = 0.0;

        foreach ($sorties as $sortie) {
            $totalSorties += (float) $sortie['montant'];

            if ((int) $sortie['frais_inclus'] === 1) {
                $totalSorties += (float) $sortie['frais'];
            }
        }

        return $totalDepot - $totalSorties;
    }
}