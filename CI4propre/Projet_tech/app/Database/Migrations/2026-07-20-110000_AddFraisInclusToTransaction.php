<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Ajoute la colonne frais_inclus sur la table transaction.
 *
 * 1 = le client a payé les frais (montant + frais débités du solde)
 * 0 = les frais sont offerts (seul le montant est débité du solde)
 *
 * Par défaut à 1 pour ne rien changer au comportement des transactions
 * déjà existantes (dépôts opérateur, anciens retraits, etc.).
 */
class AddFraisInclusToTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaction', [
            'frais_inclus' => [
                'type'       => 'INT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 1,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'frais_inclus');
    }
}