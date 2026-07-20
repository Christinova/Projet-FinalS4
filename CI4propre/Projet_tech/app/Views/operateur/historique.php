<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Historique des transactions</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/historique.css') ?>">

</head>


<body>


<div class="container">


    <div class="card">


        <h1>
            Historique des transactions
        </h1>


        <p class="subtitle">
            Liste de toutes les opérations effectuées
        </p>



        <table>


            <thead>

                <tr>

                    <th>ID</th>
                    <th>Client</th>
                    <th>Numéro</th>
                    <th>Opérateur</th>
                    <th>Montant</th>
                    <th>Type</th>
                    <th>Frais</th>
                    <th>Date</th>

                </tr>


            </thead>



            <tbody>


            <?php if (!empty($transactions)) : ?>


                <?php foreach ($transactions as $transaction) : ?>


                <tr>


                    <td>
                        <?= esc($transaction['id_transaction']) ?>
                    </td>


                    <td>
                        <?= esc($transaction['nom']) ?>
                    </td>


                    <td>
                        <?= esc($transaction['numero']) ?>
                    </td>


                    <td>
                        <?= esc($transaction['operateur']) ?>
                    </td>


                    <td class="montant">
                        <?= esc($transaction['montant']) ?> Ar
                    </td>


                    <td>

                        <span class="badge">
                            <?= esc($transaction['type_transaction']) ?>
                        </span>

                    </td>


                    <td>
                        <?= esc($transaction['frais']) ?> Ar
                    </td>


                    <td>
                        <?= esc($transaction['date_transaction']) ?>
                    </td>


                </tr>


                <?php endforeach; ?>


            <?php else : ?>


                <tr>

                    <td colspan="8" class="empty">

                        Aucune transaction disponible

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>


        </table>


        <br>


        <a href="<?= site_url('/') ?>" class="btn">

            Nouvelle transaction

        </a>


    </div>


</div>


</body>

</html>