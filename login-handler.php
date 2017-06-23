<?php

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        
        
        
if ($login && $mdp){

    $bdd = new PDO('mysql:host=localhost;dbname=afpa-bay;charset=utf8', 'root', 'admin');
    $stmt = $bdd->prepare('SELECT * FROM utilisateur WHERE login = :login');
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $utilisateur = $stmt->fetch();
    if (!$utilisateur){
        echo '<p class="alert">humm, pas trouvé d\'utilisateur </p>'.$login;
        require('login.php');
    }else{
         if (!password_verify($mdp, $utilisateur['mdp'])){
             echo '<p class="alert">humm, le mot de passe est pas bon</p>';
             require('login.php');
        }else{
            //ça semble ok, on mlet des choses dans la variable de session et on redirige vers la page d'accueil
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['current_user'] = $utilisateur['login'];
            //on redirige
            header("Location: index.php",true,303);
        }
    }

   

}else{
    echo '<p class="alert">humm bah si tu saisi pas ton login +mdp comment je peux savoir si tu es membre ?</p>';
    require('login.php');
}

