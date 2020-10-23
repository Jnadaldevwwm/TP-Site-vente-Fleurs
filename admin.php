<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Administration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoIcone.png">
</head>
<body id="pAdmin">
    <?php
        require('inc/session.inc.php');
        require('inc/navbar.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);
            if($_SESSION['autorisation']!='5'){
                header('Location: login.php');
            }
        require('inc/scriptUpload.php');
        require('inc/scriptAjoutProduit.php');
        $rqCategories = 'SELECT * FROM categorie';
        $rqAfficheBdd = 'SELECT * FROM produit';
        $resultRqBdd = $conn->query($rqAfficheBdd);
        $resultCategories = $conn->query($rqCategories);
    ?>
    <main>
        <h2>Page Administration</h2>
        <?php
        echo '<table>';
        foreach($resultRqBdd as $row){
            echo '<tr><td>'.$row['description'].'</td><td>'.$row['prix'].' €</td><td><img src="'.$row['image'].'" alt="fleur" width="100px"></td><td><form action="modif.php" method="get"><button name="modifier" value="modif'.$row['id'].'">Modifier</button><button name="modifier" value="supr'.$row['id'].'">Supprimer</button></form></td></tr>';

        }
        echo '</table>';
        ?>
        <button id='toggleAdd'>Ajouter un Article</button>

        <form enctype="multipart/form-data" action="" method="post" id="toggleForm" class="invisible">
            <fieldset>
                <legend>Ajouter un produit</legend>
                <p>
                    <label for="nomProd">Nom du produit</label>
                    <input type="text" name="nomProd" id="nomProd" placeholder="nom">
                    <label for="prixProd">Prix du produit</label>
                    <input type="number" step="any" name="prixProd" id="prixProd" placeholder="prix">
                    <label for="categProd">Catégorie du produit</label>
                    <select name="categProd" id="categProd">
                        <?php
                            foreach($resultCategories as $categ){
                                echo '<option value="'.$categ['id'].'">'.$categ['libelle'].'</option>';
                            }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Image du produit :</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                    <input name="fichier" type="file" id="fichier_a_uploader" />
                    
                </p>
                <input type="submit" name="submit" value="Ajouter" />
            </fieldset>
        </form>




    </main>
    <script src="admin.js"></script>
<?php
        require('inc/footer.inc.php');
    ?>