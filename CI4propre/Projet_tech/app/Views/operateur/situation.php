<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Situation des frais</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/situation.css') ?>">

</head>

<body>

<h1>Situation des gains</h1>

<form method="get" action="<?= site_url('situation') ?>">

    <select name="id_operateur">

        <option value="">Choisir un opérateur</option>

        <?php foreach($operateur as $op): ?>

            <option
                value="<?= $op['id_operateur'] ?>"

                <?= (isset($_GET['id_operateur']) && $_GET['id_operateur']==$op['id_operateur']) ? 'selected' : '' ?>

            >
                <?= esc($op['nom']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <button type="submit">
        Rechercher
    </button>

</form>

<br>

<?php if(!empty($transactions)): ?>

<table border="1" cellpadding="8">

<tr>

<th>Client</th>
<th>Numéro</th>
<th>Montant</th>
<th>Type</th>
<th>Frais</th>
<th>Commission</th>

</tr>

<?php foreach($transactions as $transaction): ?>

<tr>

<td><?= esc($transaction['nom']) ?></td>

<td><?= esc($transaction['numero']) ?></td>

<td><?= esc($transaction['montant']) ?> Ar</td>

<td><?= esc($transaction['type_transaction']) ?></td>

<td><?= esc($transaction['frais']) ?> Ar</td>

<td><?= esc($transaction['pourcentage_commission']) ?> Ar</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<h3>Total des frais :
<?= esc($totalFrais['total']) ?> Ar
</h3>

<h3>Total des commissions :
<?= esc($totalCommission['total']) ?> Ar
</h3>

<?php else: ?>

<p>Aucune transaction trouvée.</p>

<?php endif; ?>

</body>

</html>