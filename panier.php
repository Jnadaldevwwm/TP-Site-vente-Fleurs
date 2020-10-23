<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Votre panier</title>
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
    
        echo '<form action="confirmCommande.php"; method="get"><table><tr><td><h2>Panier</h2></td></tr>';

        foreach($_SESSION['panier'] as $row){
            $rqAffichPanier = 'SELECT * FROM produit WHERE id = :id';
            $resultRqAffPanier = $conn->prepare($rqAffichPanier);
            $resultRqAffPanier->bindParam(':id',$row,PDO::PARAM_STR);
            $resultRqAffPanier->execute();
            echo '<tr>';
            foreach($resultRqAffPanier as $row2){
                echo '<td>'.$row2['description'].'</td><td id="prix'.$row.'">'.$row2['prix'].' €</td><td><button id="moins'.$row2['id'].'">-</button><button id="plus'.$row2['id'].'">+</button></td><td><input type="number" value="1" min="0"  id="quant'.$row.'" name="quant'.$row.'"></td><td class="ssTl" id="sousTotal'.$row.'"></td><td><button id="supr'.$row2['id'].'" class="boutPoub" name="supr" value="'.$row.'"></button></td>';
            }
            echo '</tr>';
        }
        echo '<tr><td>Prix Total</td><td id="pTotal"></td></tr></table><div id="inputDiv"><button id="submit" value="commander">Valider</button></div></form>';
    ?>
    <form action="confirmCommande.php" method="post" class="formContact">
        <input type="text" name="nom" id="nom" placeholder="Votre nom">
        <input type="text" name="prenom" id="prenom" placeholder="Votre prénom">
        <input type="text" name="adresse" id="adresse" placeholder="Votre adresse">
        <input type="hidden" name="confirm" value="ok">
        <?php
        foreach($_SESSION['panier'] as $row){
            echo '<input type="hidden" id="hidden'.$row.'" name="prod'.$row.'" value="1">';
        }

        ?>
        <!-- <input type="hidden" id="totalForm" name="prixTotal" value="0"> -->
        <input type="submit" value="Confirmer Commande">
    </form>
    </main>
    <script src="panier.js"></script>
<?php
        require('inc/footer.inc.php');
    ?>