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

    /**
     * Cherche un client par son numéro complet (prefixe + numero).
     */
    public function findByNumero(string $numero)
    {
        return $this->where('numero', $numero)->first();
    }

    /**
     * Login automatique : renvoie le client s'il existe déjà,
     * sinon le crée à la volée (pas d'inscription préalable).
     */
    public function findOrCreateByNumero(string $numero, string $nom = 'Client')
    {
        $client = $this->findByNumero($numero);

        if ($client) {
            return $client;
        }

        $this->insert([
            'nom'    => $nom,
            'numero' => $numero,
        ]);

        return $this->findByNumero($numero);
    }
}
