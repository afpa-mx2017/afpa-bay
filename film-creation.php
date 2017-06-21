<?php

try
{

    $bdd = new PDO('mysql:host=localhost;dbname=afpa-bay;charset=utf8', 'root', 'admin');
    
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
    $auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_STRING);
    $acteurs = filter_input(INPUT_POST, 'acteurs', FILTER_SANITIZE_STRING);
    $date_sortie = filter_input(INPUT_POST, 'date_sortie', FILTER_SANITIZE_STRING);
 
    if ($titre && $auteur && $acteurs ){
         $stmt = $bdd->prepare('
             INSERT INTO film ( titre, auteur, acteurs, date_sortie)
                 VALUES (:titre, :auteur, :acteurs, :date_sortie)');
         $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
         $stmt->bindValue(':auteur', $auteur, PDO::PARAM_STR);
         $stmt->bindValue(':acteurs', $acteurs, PDO::PARAM_STR);
         $stmt->bindValue(':date_sortie', $date_sortie, PDO::PARAM_STR);
         
         $res = $stmt->execute();
         if ($res){
             //tout va bien
             echo 'cool!, film ajouté à la liste <a href="index.php">retour à la liste</a>';
         }else{
             echo '<p class="alert">ptit soucis ici!</p>';
             print_r($bdd->errorInfo());
         }
         //$pdo->lastInsertId();

    }else{ //ya un pb, tous les champs ne sont pas renseignés
        
        echo '<p class="alert">tous les champs sont obligatoires</p>';
        require('form-film.php');
    }
    
   
    
    
}catch (Exception $e)

{

        die('Erreur : ' . $e->getMessage());

}

