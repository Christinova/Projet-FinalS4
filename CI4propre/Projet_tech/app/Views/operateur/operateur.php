<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Opérateur</title>
</head>
<body>

<h2>Ajouter une transaction</h2>

<form action="<?= site_url('operateur/ajouter') ?>" method="post">

    <label>ID Client</label><br>
    <input type="number" name="id_client" required><br><br>

    <label>Montant</label><br>
    <input type="number" step="0.01" name="montant" required><br><br>

    <label>Type</label><br>
    <select name="type_transaction">
        <option value="depot">Dépôt</option>
        <option value="retrait">Retrait</option>
        <option value="transfert">Transfert</option>
    </select>

    <br><br>

    <button type="submit">Ajouter</button>

</form>

<hr>

<h2>Liste des transactions</h2>

<table border="1" cellpadding="5">

<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Montant</th>
    <th>Type</th>
    <th>Date</th>
</tr>

<?php foreach($transactions as $transaction): ?>

<tr>
    <td><?= esc($transaction['id_transaction']) ?></td>
    <td><?= esc($transaction['id_client']) ?></td>
    <td><?= esc($transaction['montant']) ?></td>
    <td><?= esc($transaction['type_transaction']) ?></td>
    <td><?= esc($transaction['date_transaction']) ?></td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>