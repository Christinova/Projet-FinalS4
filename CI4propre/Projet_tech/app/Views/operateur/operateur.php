<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des transactions</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/operateur.css') ?>">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Gestion des transactions</h1>

        <p class="subtitle">
            Effectuer une opération mobile money
        </p>


        <form action="<?= site_url('operateur/ajouter') ?>" method="post">


            <div class="form-group">
                <label>Nom de l'opérateur</label>

                <select name="id_operateur" required>
                    <option value="">-- Choisir un opérateur --</option>

                    <?php foreach ($operateur as $operateurs): ?>

                    <option value="<?= $operateurs['id_operateur'] ?>">
                        <?= esc($operateurs['nom']) ?>
                    </option>

                    <?php endforeach; ?>

                </select>
            </div>



            <div class="form-group">

                <label>Préfixe</label>

                <select name="prefixe" required>

                    <option value="">
                        -- Choisir le préfixe --
                    </option>


                    <?php foreach ($operateur as $operateurs): ?>

                    <option value="<?= $operateurs['prefixe'] ?>">
                        <?= esc($operateurs['prefixe']) ?>
                    </option>

                    <?php endforeach; ?>

                </select>

            </div>



            <div class="form-group">

                <label>Numéro du client</label>

                <input 
                    type="text"
                    name="numero"
                    maxlength="7"
                    placeholder="Exemple : 1234567"
                    required>

            </div>



            <div class="form-group">

                <label>Montant (Ar)</label>

                <input 
                    type="number"
                    name="montant"
                    placeholder="Exemple : 5000"
                    required>

            </div>



            <div class="form-group">

                <label>Type de transaction</label>

                <select name="type_transaction">

                    <option value="depot">
                        Dépôt
                    </option>

                    <option value="retrait">
                        Retrait
                    </option>

                    <option value="transfert">
                        Transfert
                    </option>

                </select>

            </div>



            <button class="btn">
                Valider la transaction
            </button>


        </form>


    </div>


</div>


</body>
</html>