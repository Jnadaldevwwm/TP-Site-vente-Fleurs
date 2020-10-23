<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Admin - Modif</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoIcone.png">
</head>
<body id="pModif">
    <?php
        require('inc/session.inc.php');
        require('inc/navbar.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);
            if($_SESSION['autorisation']!='5'){
                header('Location: login.php');
            }
        
        $rqSuppression = 'DELETE FROM produit WHERE id = :id';
        $rqModification = 'UPDATE produit SET description = :description, prix = :prix, image = :image, idCategorie = :categorie WHERE id = :id';
        $rqAffichage = 'SELECT p.id,p.description,p.prix,p.image,c.libelle FROM produit p INNER JOIN categorie c ON p.idCategorie = c.id WHERE p.id = :id';
        $rqCategories = 'SELECT * FROM categorie';

        $action = isset($_GET['modifier'])?$_GET['modifier']:null;
        
    ?>
    <main>
        <?php
            if(stristr($action, 'modif')){
                $idProduit = str_replace('modif','',$action);
                $resultRq = $conn->prepare($rqAffichage);
                $resultRq->bindParam(':id',$idProduit,PDO::PARAM_STR);
                $resultRq->execute();
                $resultRqCateg = $conn->query($rqCategories);

                echo '<form action="" method="get"><table><tr><td>Nom</td><td>Prix</td><td>Image</td><td>Categorie</td>';
                foreach($resultRq as $data){
                    echo '<tr><td><input type="text" name="description" value="'.$data['description'].'"></td><td><input type="text" name="prix" value="'.$data['prix'].'"></td><td><input type="text" name="image" value="'.$data['image'].'"></td><td><select name="categorie">';
                    foreach($resultRqCateg as $maCat){
                        if($data['libelle']==$maCat['libelle']){
                            echo '<option selected="selected" value="'.$maCat['id'].'">'.$maCat['libelle'].'</option>';
                        } else{
                            echo '<option value="'.$maCat['id'].'">'.$maCat['libelle'].'</option>';
                        }
                    };
                    echo '</select></td><td><input type="hidden" name="valid" value="ok"><input type="hidden" name="idProd" value="'.$data['id'].'"><input type="submit" value="Modifier"></td></tr>';
                    
                }
                echo '</table></form>';
                

            } else if(stristr($action, 'supr')){
                $idProduit = str_replace('supr','',$action);
                $resultRq = $conn->prepare($rqSuppression);
                $resultRq->bindParam(':id',$idProduit,PDO::PARAM_STR);
                $resultRq->execute();
                echo '<div id="msgRedirect">Produit supprimé... Vous allez être redirigé...';
                header('Refresh: 2; URL=admin.php');
            } else if($_GET['valid']=='ok'){
                $resultRqModif = $conn->prepare($rqModification);
                $resultRqModif->bindParam(':description', $_GET['description']);
                $resultRqModif->bindParam(':prix', $_GET['prix']);
                $resultRqModif->bindParam(':image', $_GET['image']);
                $resultRqModif->bindParam(':categorie', $_GET['categorie']);
                $resultRqModif->bindParam(':id', $_GET['idProd']);
                $resultRqModif->execute();
                header('Location: admin.php');
            }

        ?>
    </main>

<?php
        require('inc/footer.inc.php');
    ?>