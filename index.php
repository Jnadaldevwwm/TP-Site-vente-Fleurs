<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - n°1 Vente de Fleurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="pIndex">
    <?php
        require('inc/session.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        require('inc/navbar.inc.php');


        clearPanier();
        require('inc/footer.inc.php');
    ?>
