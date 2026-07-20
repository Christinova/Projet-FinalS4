<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Retrait</h1>
        <p class="subtitle">Choisissez si vous payez les frais</p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= site_url('client/retrait') ?>" method="post">

            <div class="form-group">
                <label>Montant (Ar)</label>
                <input
                    type="number"
                    name="montant"
                    min="1"
                    step="any"
                    placeholder="Exemple : 5000"
                    value="<?= esc(old('montant')) ?>"
                    required>
            </div>

            <div class="form-group form-check">
                <label>
                    <input type="checkbox" name="payer_frais" value="1" checked>
                    Payer les frais (décochez pour les frais offerts)
                </label>
            </div>

            <button type="submit" class="btn">Valider le retrait</button>

        </form>

        <a href="<?= site_url('client') ?>" class="back-link">&larr; Retour</a>

    </div>

</div>

</body>
</html>