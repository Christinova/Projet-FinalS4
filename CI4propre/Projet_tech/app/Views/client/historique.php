<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mon historique</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/historique.css') ?>">

</head>


<body>


<div class="container">


    <div class="card">


        <h1>
            Mon historique
        </h1>


        <p class="subtitle">
            Liste de vos opérations
        </p>



        <table>


            <thead>

                <tr>

                    <th>ID</th>
                    <th>Opérateur</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Frais</th>
                    <th>Destinataire</th>
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
                        <?= esc($transaction['operateur']) ?>
                    </td>


                    <td>

                        <span class="badge">
                            <?= esc($transaction['type_transaction']) ?>
                        </span>

                    </td>


                    <td class="montant">
                        <?= esc($transaction['montant']) ?> Ar
                    </td>


                    <td>
                        <?= esc($transaction['frais']) ?> Ar
                    </td>


                    <td>
                        <?= esc($transaction['numero_destinataire'] ?? '-') ?>
                    </td>


                    <td>
                        <?= esc($transaction['date_transaction']) ?>
                    </td>


                </tr>


                <?php endforeach; ?>


            <?php else : ?>


                <tr>

                    <td colspan="7" class="empty">

                        Aucune transaction disponible

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>


        </table>


        <br>


        <a href="<?= site_url('client') ?>" class="btn">

            Retour au tableau de bord

        </a>


    </div>


</div>


</body>

</html>
