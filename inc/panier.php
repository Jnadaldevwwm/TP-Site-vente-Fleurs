<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Votre panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="pCatalogue">
    <?php
        require('inc/session.inc.php');
        require('inc/navbar.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);

        $rqAffichPanier = 'SELECT * FROM produit';
        $resultRqAffPanier = $conn->query($rqAffichPanier);
    ?>
    <main>
    <?php
        //echo '<table><tr><td><h2>Votre Panier</h2></td></tr>';
        var_dump($_SESSION['panier']);
        foreach($_SESSION['panier'] as $row){
            echo $row;

        }
    ?>

    </main>

<?php
        require('inc/footer.inc.php');
    ?>