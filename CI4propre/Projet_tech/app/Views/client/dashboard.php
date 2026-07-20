<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Bonjour <?= esc($nom_client) ?></h1>
        <p class="infos-client"><?= esc($operateur) ?> — <?= esc($numero) ?></p>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <div class="solde-card">
            <div class="label">Solde disponible</div>
            <div class="montant"><?= number_format($solde, 0, ',', ' ') ?> Ar</div>
        </div>

        <div class="menu-grid">

            <a href="<?= site_url('client/depot') ?>" class="menu-item">
                <span class="icon">⬇️</span>
                Dépôt
            </a>

            <a href="<?= site_url('client/retrait') ?>" class="menu-item">
                <span class="icon">⬆️</span>
                Retrait
            </a>

            <a href="<?= site_url('client/transfert') ?>" class="menu-item">
                <span class="icon">↔️</span>
                Transfert
            </a>

            <a href="<?= site_url('client/historique') ?>" class="menu-item">
                <span class="icon">🧾</span>
                Historique
            </a>

        </div>

        <a href="<?= site_url('client/logout') ?>" class="link-logout">Se déconnecter</a>

    </div>

</div>

</body>
</html>
