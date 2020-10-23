<?php 
session_start();
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = array();
}

function ajoutPanier($prod){
    if($prod!='' && $prod!=null){
        if(in_array($prod,$_SESSION['panier'])){
            return '<p class="wrongTxt">Déja dans le panier</p>';
        } else{
            $_SESSION['panier'][] = $prod;
            return '<p class="rightTxt">Ajouté au panier</p>';
        }
    }
}

function clearPanier(){
    unset($_SESSION['panier']);
}
?>