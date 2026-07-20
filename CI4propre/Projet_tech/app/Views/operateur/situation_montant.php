<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>
        Situation des montants
    </title>

    <link rel="stylesheet" href="<?= base_url('assets/css/situation_montant.css') ?>">

</head>


<body>


<div class="container">


    <div class="card">


        <h1>
            Situation des montants par opérateur
        </h1>


        <p class="subtitle">
            Visualisation des opérations effectuées par opérateur
        </p>



        <form method="get" action="<?= site_url('situation_montant') ?>">


            <select name="id_operateur" required>


                <option value="">
                    Choisir un opérateur
                </option>


                <?php foreach($operateur as $op): ?>


                    <option 
                    value="<?= $op['id_operateur'] ?>"

                    <?= 
                    (isset($_GET['id_operateur']) 
                    && $_GET['id_operateur']==$op['id_operateur']) 
                    ? 'selected' 
                    : '' 
                    ?>

                    >

                        <?= esc($op['nom']) ?>


                    </option>


                <?php endforeach; ?>


            </select>


            <button type="submit">
                Rechercher
            </button>


        </form>




<?php if(!empty($transactions)): ?>


        <table>


            <thead>

                <tr>

                    <th>ID</th>

                    <th>Client</th>

                    <th>Numéro</th>

                    <th>Type</th>

                    <th>Montant</th>

                    <th>Frais</th>

                    <th>Date</th>


                </tr>


            </thead>



            <tbody>


            <?php foreach($transactions as $transaction): ?>


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

                        <?= esc($transaction['date_transaction']) ?>

                    </td>


                </tr>



            <?php endforeach; ?>


            </tbody>


        </table>



        <div class="total">


            Total des montants :

            <strong>

                <?= esc($totalMontant['total']) ?> Ar

            </strong>


        </div>




<?php else: ?>


<p class="empty">

Aucune transaction trouvée pour cet opérateur.

</p>



<?php endif; ?>



<br>


<a href="<?= site_url('/') ?>" class="btn">

Nouvelle transaction

</a>



    </div>


</div>


</body>

</html>