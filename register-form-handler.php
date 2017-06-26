<?php

include('model/dao/UserDAO.php');

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$mdp_verif = filter_input(INPUT_POST, 'mdp_verif', FILTER_SANITIZE_STRING);
$email  = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


$errorMsg = "";
//test champs obligatoires:
if (!($login && $mdp && $mdp_verif && $email)){
    $errorMsg = "tous les champs sont obligatoires per favore";
}


if (!$email){
    $errorMsg = "sur sur que vous avez saisie une adresse email valide ?";
}

if ($mdp != $mdp_verif){
    $errorMsg = "humm, ptit soucis en retapant le mdp ?";
}

if (!empty($errorMsg)){
    echo '<p class="alert">'.$errorMsg.'</p>';
    require('register-form.php');
    exit; //on va pas plus loin
}

$user = array("login" => $login, "mdp" => password_hash($mdp, PASSWORD_BCRYPT), "email"=> $email);
try {
    $res = UserDAO::save($user);
    if ($res) {
     echo '<p class="info">cool votre compte à été créé, merci de vous authentifier</p>';
     require('login.php');
    }else{
        echo '<p class="alert">oulala ya un soucis coté bdd</p>';
        require('register-form.php');
        exit; //on va pas plus loin
    }
} catch (AlreadyExistException $exc) {
     echo '<p class="alert">mais ché déjà pris ce login boudiou!</p>';
    require('register-form.php');
}

