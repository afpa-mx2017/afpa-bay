<?php

include('DBConnect.php');

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
        $stmt = $bdd->query('SELECT * from film');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    /**
     * 
     * @param type $search_string
     * @return type tableau de film
     */
    public static function findByTitle($search_string){
        $stmt = $bdd->prepare('SELECT * from film WHERE titre like :recherche');
        $stmt->bindValue(':recherche', '%'.$search_string.'%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
    public static function findByBookMarked($userId){
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
        $stmt = $bdd->prepare('
             INSERT INTO film ( titre, auteur, acteurs, date_sortie)
                 VALUES (:titre, :auteur, :acteurs, :date_sortie)');
         $stmt->bindValue(':titre', $film['titre'], PDO::PARAM_STR);
         $stmt->bindValue(':auteur', $film['auteur'], PDO::PARAM_STR);
         $stmt->bindValue(':acteurs', $film['acteurs'], PDO::PARAM_STR);
         $stmt->bindValue(':date_sortie', $film['date_sortie'], PDO::PARAM_STR);
         
         $res =  $stmt->execute();
         if ($res){
             $film['id'] = $bdd->lastInsertId();
            return true;
        }else {
            return false;
        }
    }
}
    

