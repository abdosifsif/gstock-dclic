<?php
@session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect the user to the login page or display an error message
    header('Location: /gstock/index.php');
    exit();
}

@include 'entete.php';

if (!empty($_GET['id'])) {
    $commande = getCommande($_GET['id']);
}

?>
<div class="home-content">


    <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"> <i class='bx bx-printer'></i> Imprimer</button>


    <div class="page">
        <div class="cote-a-cote">
            <img class="bx bxl" src="../public/images/ocp.png" alt="">
            <div>
                <p>Reçu N° #: <?= $commande['id'] ?> </p>
                <p>Date: <?= date('d/m/Y H:i:s', strtotime($commande['date_commande'])) ?> </p>
            </div>
        </div>

        <div class="cote-a-cote" style="width: 50%;">
            <p>Nom du fournisseur :</p>
            <p><?= $commande['nom'] . " " . $commande['prenom'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Tel :</p>
            <p><?= $commande['telephone'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Adresse :</p>
            <p><?= $commande['adresse'] ?></p>
        </div>

        <br>

        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>

            <tr>
                <td><?= $commande['nom_article'] ?></td>
                <td><?= $commande['quantite'] ?></td>
                <td><?= $commande['prix_unitaire'] ?></td>
                <td><?= $commande['prix'] ?></td>
            </tr>
        </table>
    </div>


</div>
</section>

<?php
include 'pied.php';
?>
<script>

    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });

</script>
