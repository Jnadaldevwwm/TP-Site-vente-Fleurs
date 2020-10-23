<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Catalogue</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoIcone.png">
</head>
<body id="pCatalogue">
    <?php
        require('inc/session.inc.php');
        
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);

        $currentCat = isset($_GET['categories'])?$_GET['categories']:null;
        $rqAffichage = 'SELECT p.id, p.description, p.prix, p.image, c.libelle FROM produit p INNER JOIN categorie c ON p.idCategorie = c.id WHERE c.libelle = :categ';

        $rqCategorie = 'SELECT libelle FROM categorie';
        $resultCateg = $conn->query($rqCategorie);
        ?>
    
        <div id="infoBullePanier">
            <?= ajoutPanier(isset($_POST['panier'])?$_POST['panier']:null);
             ?>
        </div>
        <?php require('inc/navbar.inc.php');?>
    <main>
        
        
        <div id="titre">
            <img src="images/gaucheDeco" alt="deco" class="fior1">
            <h2>Catalogue</h2>
            <img src="images/droiteDeco.png" alt="deco" class="fior1">
        </div>
    <?php
        echo "<form action='' method='GET' id='sCatForm'><select name='categories'><option value=''>**Choisir Catégorie**</option>";
        foreach($resultCateg as $row){
            echo '<option value="'.$row['libelle'].'">'.ucfirst($row['libelle']).'</option>';
        }
        echo '<input type="submit" value="Choisir"></form>';
    //affichage tableau catégorie
        if($currentCat!='' AND $currentCat!=null){
            $resRqAff = $conn->prepare($rqAffichage);
            $resRqAff->bindParam(':categ',$currentCat,PDO::PARAM_STR);
            $resRqAff->execute();
            echo '<table><tr><td><h2>'.ucfirst($currentCat).'</h2></td></tr>';
            foreach($resRqAff as $row){
                echo '<tr><td>'.$row['description'].'</td><td>'.$row['prix'].' €</td><td><img src="'.$row['image'].'" alt="fleur"></td><td><form action="" method="POST"><button id="'.$row['id'].'" value="'.$row['id'].'" name="panier">+ Panier</button></form></tr>';
            }
            echo '</table><a href="panier.php" id="voirP">Voir Panier</a>';
            echo $_POST['panier'];
        }
    ?>





    </main>
    <?php
        require('inc/footer.inc.php');
    ?>