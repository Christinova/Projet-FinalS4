<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Ajoute la colonne numero_destinataire sur la table transaction.
 *
 * Sert uniquement à tracer vers quel numéro un transfert a été envoyé.
 * Un transfert ne crédite aucun compte dans le système : c'est une sortie
 * d'argent, exactement comme un retrait (montant + frais débités chez
 * l'expéditeur).
 */
class AddNumeroDestinataireToTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaction', [
            'numero_destinataire' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'numero_destinataire');
    }
}
