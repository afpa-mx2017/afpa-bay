<?php
namespace AfpaBay\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use AfpaBay\Model\Dao\FilmDAO;
use AfpaBay\Model\Dao\GenreDAO;

/**
 * Description of FilmController
 *
 * @author lionel
 */
class FilmController extends Controller {
    
    
    public function indexAction(){
        $recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_STRING);
        if ($recherche){

           $films =  FilmDAO::findByTitle($recherche);

        }else{
           $films = FilmDAO::findAll();

        }
        
        //on va chercher la liste des films 'bookmarqué'
        $vus = [];
        if (isset($_SESSION['user_id'])){
           $vus = FilmDAO::findByBookMarked($_SESSION['user_id']);

        }
        
        //on rajoute le flag 'vu' ou pas vu pour chaque film
        foreach ($films as &$film){
          $film['vu'] = in_array($film['id'], $vus);
        }
        
        
        return $this->template->render('film-list', array('films' => $films, 'recherche'=> $recherche));
        
        
    }
    
    public function newAction($opts){
        $genres = GenreDAO::findAll();
        $data = [];
        $data["genres"] = $genres;
        if ($opts) $data = array_merge($data, $opts);
      
        return $this->template->render('film-form', $data );
    }
    
    public function createAction(){
        
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
        $auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_STRING);
        $acteurs = filter_input(INPUT_POST, 'acteurs', FILTER_SANITIZE_STRING);
        $date_sortie = filter_input(INPUT_POST, 'date_sortie', FILTER_SANITIZE_STRING);
        $genre = filter_input(INPUT_POST, 'genre', FILTER_VALIDATE_INT);

        if ($titre && $auteur && $acteurs ){
            $film = [];
            $film['titre'] = $titre;
            $film['auteur'] = $auteur;
            $film['acteurs'] = $acteurs;
            $film['date_sortie'] = $date_sortie;
            $film['genre'] = $genre;
            $res = FilmDAO::save($film);

             if ($res){
                 //tout va bien
                 return $this->newAction(array("success"=> "cool!, film ajouté à la liste <a href=\"/\">retour à la liste</a>"));
             }else{
                 return $this->newAction(array("error"=> "ptit soucis ici, un champ semble foireux!"));
             }
             //$pdo->lastInsertId();

        }else{ //ya un pb, tous les champs ne sont pas renseignés
           return $this->newAction(array("error"=> "tous les champs sont obligatoires"));
        }
    }
    
    public function updateAction($id){
        
        $seen = filter_input(INPUT_POST, 'seen', FILTER_VALIDATE_BOOLEAN);



        if (is_null($seen)){
            http_response_code(400);
        }

           
        $res = FilmDAO::toggleBookmark($id, $this->getCurrentUser(), $seen);
        if ($res){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
             


      
        
    }
    
}
