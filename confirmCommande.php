<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Confirmation Commande</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoIcone.png">
</head>
<body id="pPanier">
    <?php
        require('inc/session.inc.php');
        require('inc/navbar.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);
    ?>
    <main>
    <?php
        if(isset($_GET['supr'])){
            $supression = $_GET['supr'];
            //unset($_SESSION['panier'][$supression]);
            //header('Location: panier.php');
            if (($cle = array_search($supression, $_SESSION['panier'])) !== false) {
                unset($_SESSION['panier'][$cle]);
            }
            header('Location: panier.php');
        }
        if(isset($_POST['confirm'])){
            $rqFleurs = 'SELECT * FROM produit';
            $resultRqFleurs = $conn->query($rqFleurs);
            echo '<p> Monsieur '.$_POST['prenom'].' '.$_POST['nom'].', nous vous confirmons la commande';

        }
    ?>





    </main>

<?php
        require('inc/footer.inc.php');
    ?>