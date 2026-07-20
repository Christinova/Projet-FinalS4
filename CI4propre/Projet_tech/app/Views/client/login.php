<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion client</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Espace client</h1>
        <p class="subtitle">Connectez-vous avec votre numéro de téléphone</p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= site_url('client/login') ?>" method="post">

            <div class="form-group">
                <label>Opérateur</label>

                <select name="prefixe" required>
                    <option value="">-- Choisir un opérateur --</option>

                    <?php foreach ($operateur as $operateurs) : ?>
                        <option value="<?= esc($operateurs['prefixe']) ?>">
                            <?= esc($operateurs['nom']) ?> (<?= esc($operateurs['prefixe']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Numéro de téléphone</label>
                <input
                    type="text"
                    name="numero"
                    maxlength="7"
                    placeholder="Exemple : 1234567"
                    required>
            </div>

            <button type="submit" class="btn">Se connecter</button>

        </form>

    </div>

</div>

</body>
</html>
