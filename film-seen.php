<?php

session_start();

include('model/dao/FilmDAO.php');

$idFilm = filter_input(INPUT_POST, 'film_id', FILTER_VALIDATE_INT);
$seen = filter_input(INPUT_POST, 'seen', FILTER_VALIDATE_BOOLEAN);

if ($idFilm && isset($_SESSION['user_id'])){
    
    $res = FilmDAO::toggleBookmark($idFilm, $_SESSION['user_id'], $seen);

    if ($res){
        http_response_code(200);
    }else{
        http_response_code(400);
    }
    
    
}else{
    http_response_code(403); //forbuidden
}
