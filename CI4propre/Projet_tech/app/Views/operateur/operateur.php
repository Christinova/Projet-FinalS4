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

            <select name="id_operateur" id="operateur" required>

                <option value="">-- Choisir un opérateur --</option>

                <?php foreach ($operateur as $op): ?>

                    <option
                        value="<?= $op['id_operateur'] ?>"
                        data-prefixe="<?= esc($op['prefixe']) ?>">

                        <?= esc($op['nom']) ?>

                    </option>

                <?php endforeach; ?>

            </select>
            </div>

               <div class="form-group">

    <label>Préfixe</label>

    <input type="text" id="prefixe" name="prefixe" readonly placeholder="Choisissez un opérateur" required>

</div>

<div class="form-group">

                <label>Numéro de l'opérateur</label>

                <input 
                    type="text"
                    name="numero"
                    maxlength="7"
                    placeholder="Exemple : 1234567"
                    required>

            </div>

            <div class="form-group">
                <label>Nom de l'opérateur du client</label>

            <select name="id_operateur_client" id="operateur2" required>

                <option value="">-- Choisir un opérateur --</option>

                <?php foreach ($operateur as $op): ?>

                    <option
                        value="<?= $op['id_operateur'] ?>"
                        data-prefixe="<?= esc($op['prefixe']) ?>">

                        <?= esc($op['nom']) ?>

                    </option>

                <?php endforeach; ?>

            </select>
            </div>



           <div class="form-group">

    <label>Préfixe</label>

    <input type="text" id="prefixe2" name="prefixe2" readonly placeholder="Choisissez un opérateur" required>

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
            <button class="btn2">
                    <a href="<?= site_url('historique') ?>" class="btn operateur">

                Historique des transactions
                </a>
            </button>
        


        </form>


    </div>


</div>
<script>

    const operateur = document.getElementById("operateur");
    const prefixe = document.getElementById("prefixe");

    operateur.addEventListener("change", function () {

        const option = this.options[this.selectedIndex];

        prefixe.value = option.dataset.prefixe || "";

});

    const operateur2 = document.getElementById("operateur2");
    const prefixe2 = document.getElementById("prefixe2");

    operateur2.addEventListener("change", function () {

        const option = this.options[this.selectedIndex];

        prefixe2.value = option.dataset.prefixe || "";

});

</script>

</body>
</html>