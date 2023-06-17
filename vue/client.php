<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $client = getClient($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">
                <label for="nom">Nom_du_service</label>
                <input value="<?= !empty($_GET['id']) ?  $client['nom_du_service'] : "" ?>" type="text" name="nom_du_service" id="nom" placeholder="Veuillez saisir le nom du service">
                <input value="<?= !empty($_GET['id']) ?  $client['id'] : "" ?>" type="hidden" name="id" id="id" >

                <label for="telephone">N° de téléphone</label>
                <input value="<?= !empty($_GET['id']) ?  $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Veuillez saisir le N° de téléphone">
                
                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id']) ?  $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Veuillez saisir l'adresse">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>

        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom_du_service</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
                <?php
                $clients = getClient();

                if (!empty($clients) && is_array($clients)) {
                    foreach ($clients as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_du_service'] ?></td>
                            
                            <td><?= $value['telephone'] ?></td>
                            <td><?= $value['adresse'] ?></td>
                            <td>
                                <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a onclick="deleteClient(<?= $value['id'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
        </div>
    </div>

</div>
</section>

<?php
include 'pied.php';
?>
<script>
    function deleteClient(clientId) {
    if (confirm("Voulez-vous vraiment supprimer ce client ?")) {
        window.location.href = "../model/deleteClient.php?clientId=" + clientId;
    }
}
</script>