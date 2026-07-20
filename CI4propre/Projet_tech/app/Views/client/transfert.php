<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Transfert</h1>
        <p class="subtitle">Montant + frais seront débités de votre solde</p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= site_url('client/transfert') ?>" method="post">

                    <div class="form-group">
                <label>Destinataires</label>

                <div id="liste-destinataires">

                    <div class="destinataire">
                        <input
                            type="text"
                            name="numeros[]"
                            class="numero"
                            placeholder="Numéro"
                            required>

                        <button type="button" class="supprimer">
                            ✖
                        </button>
                    </div>

                </div>

                <button type="button" id="ajouter">
                    + Ajouter un destinataire
                </button>
            </div>

            <div class="form-group">
                <label>Montant total</label>

                <input
                    type="number"
                    id="montant"
                    name="montant"
                    required>
            </div>

            <p id="resume"></p>

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

            <button type="submit" class="btn">Valider le transfert</button>

        </form>

        <a href="<?= site_url('client') ?>" class="back-link">&larr; Retour</a>

    </div>

</div>

<script>

const liste = document.getElementById("liste-destinataires");
const ajouter = document.getElementById("ajouter");
const montant = document.getElementById("montant");
const resume = document.getElementById("resume");

function mettreAJourResume(){

    const nb = document.querySelectorAll(".numero").length;

    const total = parseFloat(montant.value || 0);

    if(nb == 0){
        resume.innerHTML = "";
        return;
    }

    const part = Math.floor(total / nb);

    resume.innerHTML =
        "<strong>"+nb+"</strong> destinataire(s)<br>" +
        "≈ <strong>"+part.toLocaleString()+" Ar</strong> chacun";

}

ajouter.onclick = function(){

    const ligne = document.createElement("div");

    ligne.className = "destinataire";

    ligne.innerHTML = `
        <input
            type="text"
            name="numeros[]"
            class="numero"
            placeholder="Numéro"
            required>

        <button
            type="button"
            class="supprimer">
            ✖
        </button>
    `;

    liste.appendChild(ligne);

    mettreAJourResume();

};

document.addEventListener("click", function(e){

    if(e.target.classList.contains("supprimer")){

        if(document.querySelectorAll(".destinataire").length > 1){

            e.target.parentElement.remove();

            mettreAJourResume();

        }

    }

});

document.addEventListener("input", mettreAJourResume);

</script>
</body>
</html>
