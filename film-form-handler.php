<?php

include('model/dao/FilmDAO.php');

    
$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
$auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_STRING);
$acteurs = filter_input(INPUT_POST, 'acteurs', FILTER_SANITIZE_STRING);
$date_sortie = filter_input(INPUT_POST, 'date_sortie', FILTER_SANITIZE_STRING);
$genre = filter_input(INPUT_POST, 'genre', FILTER_VALIDATE_INT);

if ($titre && $auteur && $acteurs ){
     
    $film['titre'] = $titre;
    $film['auteur'] = $auteur;
    $film['acteurs'] = $acteurs;
    $film['date_sortie'] = $date_sortie;
    $film['genre'] = $genre;
    $res = FilmDAO::save($film);
    
     if ($res){
         //tout va bien
         echo 'cool!, film ajouté à la liste <a href="index.php">retour à la liste</a>';
     }else{
         echo '<p class="alert">ptit soucis ici, un champ semble foireux!</p>';
         require('film-form.php');
     }
     //$pdo->lastInsertId();

}else{ //ya un pb, tous les champs ne sont pas renseignés

    echo '<p class="alert">tous les champs sont obligatoires</p>';
    require('film-form.php');
}
    
   
    
    

