<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR - Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoIcone.png">
</head>
<body id="pLogin">
    <?php
        require('inc/session.inc.php');
        require('inc/navbar.inc.php');
        require('inc/idConnect.php');
        require('inc/connect.php');
        $conn = connection(SERVERNAME,DATABASE,USERNAME,PASSWORD);

        $rqUser ='SELECT * FROM utilisateur';
        if(($_POST['login']!=''&&$_POST['login']!=null)&&($_POST['pass']!=''&&$_POST['pass']!=null)){
            $resultUser = $conn->query($rqUser);
            foreach($resultUser as $user){
                if($_POST['login']==$user['login']&&$_POST['pass']==$user['password']){
                    $_SESSION['autorisation']=5;
                    header('Location: admin.php');
                }
            }
        }
    ?>
    <main>
        <h2>Connexion</h2>
        <img src="images/centreDeco.png" alt="decoration" id="deco">
        <form action="" method="post">
            <input type="text" name="login" id="login" placeholder="Nom utilisateur">
            <input type="password" name="pass" id="pass" placeholder="Mot de passe">
            <input type="submit" value="Se connecter">
        </form>





    </main>

<?php
        require('inc/footer.inc.php');
    ?>