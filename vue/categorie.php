<?php
@session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect the user to the login page or display an error message
    header('Location: /gstock/index.php');
    exit();
}
@include 'entete.php';

if (!empty($_GET['id'])) {
    $categorie = getCategorie($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifCategorie.php" : "../model/ajoutCategorie.php" ?>" method="post">
                <label for="libelle_categorie">Libelle</label>
                <input value="<?= !empty($_GET['id']) ?  $categorie['libelle_categorie'] : "" ?>" type="text" name="libelle_categorie" id="libelle_categorie" placeholder="Veuillez saisir le libéllé">
                <input value="<?= !empty($_GET['id']) ?  $categorie['id'] : "" ?>" type="hidden" name="id" id="id" >

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
                    <th>Libelle categorie</th>
                    <th>Action</th>
                </tr>
                <?php
                $categories = getCategorie();

                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td>
                                <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i>
                                <a onclick="deleteCategorie(<?= $value['id'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                            </a></td>
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
    function deleteCategorie(CategorieId) {
    if (confirm("Voulez-vous vraiment supprimer ce Categorie ?")) {
        window.location.href = "../model/deleteCategorie.php?CategorieId=" + CategorieId;
    }
}
</script>