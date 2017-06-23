<?php

session_start();

$idFilm = filter_input(INPUT_POST, 'film_id', FILTER_VALIDATE_INT);
$seen = filter_input(INPUT_POST, 'seen', FILTER_VALIDATE_BOOLEAN);

if ($idFilm && isset($_SESSION['user_id'])){
    
    $bdd = new PDO('mysql:host=localhost;dbname=afpa-bay;charset=utf8', 'root', 'admin');
    $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    
    //enregistrement existant ?
    $stmt = $bdd->prepare('
             SELECT * FROM utilisateur_film WHERE film_id = :film_id AND utilisateur_id = :user_id');
    $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', (int)$_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();

    if ($res){ //update
        
        $stmt = $bdd->prepare('
             UPDATE utilisateur_film SET vu = :seen WHERE film_id = :film_id AND utilisateur_id = :user_id');
        $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', (int)$_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':seen', $seen, PDO::PARAM_BOOL);

    
    //faire test si existe ou pas
    
        $res = $stmt->execute();

        
    }else{
            //insert
        $stmt = $bdd->prepare('
             INSERT INTO utilisateur_film (film_id, utilisateur_id, vu) VALUES (:film_id, :user_id, :seen)');
        $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', (int)$_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':seen', $seen, PDO::PARAM_BOOL);
        
        $res = $stmt->execute();

    }

    if ($res){
        http_response_code(200);
    }else{
        http_response_code(400);
    }
    
    
}else{
    http_response_code(403); //forbuidden
}
