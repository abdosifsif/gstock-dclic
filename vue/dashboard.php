<?php
@include 'entete.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect the user to the login page or display an error message
    header('Location: /gstock/index.php');
    exit();
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Commande</div>
                <div class="number"><?php echo getAllCommande()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Distribution</div>
                <div class="number"><?php echo getAllVente()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Article</div>
                <div class="number"><?php echo getAllArticle()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart cart three"></i>
        </div>
        
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="title">Distribution recentes</div>
            <?php
            $ventes = getLastVente();
            ?>
            <div class="sales-details">
                <ul class="details">
                    <li class="topic">Date</li>
                    <?php
                    foreach ($ventes as $key => $value) {
                    ?>
                        <li><a href="#"><?php echo date('d M Y', strtotime($value['date_vente'])) ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">Service</li>
                    <?php
                    foreach ($ventes as $key => $value) {
                    ?>
                        <li><a href="#"><?php echo $value['nom_du_service'] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">Article</li>
                    <?php
                    foreach ($ventes as $key => $value) {
                    ?>
                        <li><a href="#"><?php echo $value['nom_article'] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">Prix</li>
                    <?php
                    foreach ($ventes as $key => $value) {
                    ?>
                        <li><a href="#"><?php echo number_format($value['prix'], 0, ",", " ") . " dhs" ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="button">
                <a href="#">Voir Tout</a>
            </div>
        </div>
        <div class="top-sales box">
            <div class="title">Article le plus distribué</div>
            <ul class="top-sales-details">
                <?php
                $article = getMostVente();
                foreach ($article as $key => $value) {
                ?>
                    <li>
                        <a href="#">
                            <!--<img src="images/sunglasses.jpg" alt="">-->
                            <span class="product"><?php echo $value['nom_article'] ?></span>
                        </a>
                        <span class="price"><?php echo number_format($value['prix'], 0, ",", " ") . " dhs" ?></span>
                    </li>
                <?php
                }
                ?>
                
            </ul>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php';
?>