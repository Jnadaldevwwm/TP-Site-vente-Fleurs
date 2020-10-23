<nav>
    <a href="index.php" class='left'>
        <img src="images/logo.png" alt="logo lafleur">
    </a>
    <div id="liens">
        <a href="index.php" class='left'>Accueil</a>
        <a href="catalogue.php" class='left'>Catalogue</a>
        <a href="panier.php" class='left'>Panier<?php if(count($_SESSION['panier'])>0){
            echo '<span>'.count($_SESSION['panier']).'</span>'; }?></a>
        <a href="admin.php" class='left'>Administer</a>
        <?php 
            if(isset($_SESSION['autorisation']) && $_SESSION['autorisation']=='5'){
                echo '<a href="inc/deco.php">Déconnection</a>';
            }
        ?>
    </div>
</nav>