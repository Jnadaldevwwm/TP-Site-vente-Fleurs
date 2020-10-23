<?php
if(!empty($_POST)){
    if(!empty($_POST['nomProd'])&&!empty($_POST['prixProd'])&&!empty($_POST['categProd'])){
        $nomProduit = $_POST['nomProd'];
        $prixProduit = $_POST['prixProd'];
        $categProduit = $_POST['categProd'];
        $imageProduit = $_FILES['fichier']['name'];
        $imageProduit = 'images/fleurs/'.$imageProduit;

        $rqAjoutProduit = 'INSERT INTO produit VALUES (null,:nom,:prix,:imagel,:categorie)';
        $resultRq = $conn->prepare($rqAjoutProduit);
        $resultRq->bindParam(':nom',$nomProduit,PDO::PARAM_STR);
        $resultRq->bindParam(':prix',$prixProduit,PDO::PARAM_STR);
        $resultRq->bindParam(':imagel',$imageProduit,PDO::PARAM_STR);
        $resultRq->bindParam(':categorie',$categProduit,PDO::PARAM_INT);
        $resultRq->execute();
    }


}
?>