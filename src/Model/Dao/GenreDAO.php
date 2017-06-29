<?php


namespace AfpaBay\Model\Dao;
use \PDO;


include_once('DBConnect.php');
/**
 * Description of Genre
 *
 * @author lionel
 */
class GenreDAO {


    
    /**
     * 
     * @return type tableau de genre
     */
    public static function findAll(){
        $bdd = connectDB(); 
        $stmt = $bdd->query('SELECT * from genre');
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
}
