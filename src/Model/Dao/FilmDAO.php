<?php
namespace AfpaBay\Model\Dao;

use \PDO;

include_once('DBConnect.php');

/**
 * Description of filmdao
 *
 * @author lionel
 */
class FilmDAO {
   
    
    /**
     * 
     * @return type tableau de film
     */
    public static function findAll(){
        $bdd = connectDB(); 
        $stmt = $bdd->query('SELECT film.id, film.titre, film.auteur, film.acteurs, film.date_sortie,film.thumbnail, genre.nom as genre  from film  INNER JOIN genre  ON film.genre_id = genre.id');
        $res =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($res);
        return $res;
        
    }
    
    /**
     * 
     * @param type $search_string
     * @return type tableau de film
     */
    public static function findByTitle($search_string){
        $bdd = connectDB();
        $stmt = $bdd->prepare('SELECT * from film WHERE titre like :recherche');
        $stmt->bindValue(':recherche', '%'.$search_string.'%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
    public static function findByBookMarked($userId){
        $bdd = connectDB();
        $vus = [];
        $stmt = $bdd->prepare('SELECT film_id fROM utilisateur_film WHERE vu = 1 AND utilisateur_id = :user_id');
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        while ($row = $stmt->fetch()){
            $vus[] = $row['film_id'];
        }
        
        return $vus;
    }

    /**
     * 
     * @param type $film
     * @return type boolean true si operation réussie
     */
    public static function save($film){
        $bdd = connectDB();
        $stmt = $bdd->prepare('
             INSERT INTO film ( titre, auteur, acteurs, date_sortie, genre_id)
                 VALUES (:titre, :auteur, :acteurs, :date_sortie, :genre)');
         $stmt->bindValue(':titre', $film['titre'], PDO::PARAM_STR);
         $stmt->bindValue(':auteur', $film['auteur'], PDO::PARAM_STR);
         $stmt->bindValue(':acteurs', $film['acteurs'], PDO::PARAM_STR);
         $stmt->bindValue(':date_sortie', $film['date_sortie'], PDO::PARAM_STR);
         $stmt->bindValue(':genre', $film['genre'], PDO::PARAM_INT);
         
         $res =  $stmt->execute();
         if ($res){
             $film['id'] = $bdd->lastInsertId();
            return true;
        }else {
            return false;
        }
    }
    
    
    public static function toggleBookmark($idFilm, $userId, $bookmark){
        $bdd = connectDB();
    
        //enregistrement existant ?
        $stmt = $bdd->prepare('SELECT * FROM utilisateur_film WHERE film_id = :film_id AND utilisateur_id = :user_id');
        $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();

        if ($res){ //update

            $stmt = $bdd->prepare('
                 UPDATE utilisateur_film SET vu = :bookmark WHERE film_id = :film_id AND utilisateur_id = :user_id');
            $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':bookmark', $bookmark, PDO::PARAM_BOOL);


        //faire test si existe ou pas

            $res = $stmt->execute();


        }else{
                //insert
            $stmt = $bdd->prepare('
                 INSERT INTO utilisateur_film (film_id, utilisateur_id, vu) VALUES (:film_id, :user_id, :bookmark)');
            $stmt->bindValue(':film_id', $idFilm, PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':bookmark', $bookmark, PDO::PARAM_BOOL);

            $res = $stmt->execute();
        }
        
        return $res;
    }
 }
    

