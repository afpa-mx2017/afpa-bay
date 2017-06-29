<?php
namespace AfpaBay\Model\Dao;

use \PDO;
use AfpaBay\Exceptions\AlreadyExistException;

include_once('DBConnect.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDAO
 *
 * @author lionel
 */
class UserDAO {
   
    /**
     * sauvegarde un utilisateur en bdd
     * @param type $user tableau associatif
     * @return boolean true si insertion ok
     * @throws AlreadyExistException si l'utilisateur existe déjà
     */
    public static function save($user){
        $bdd = connectDB();
        
        //exist déjà ?
        $stmt = $bdd->prepare('SELECT * FROM utilisateur WHERE login = :login');
        $stmt->bindValue(':login', $user['login']);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_NUM);
        if( $rows > 0 ){
           throw new AlreadyExistException();
        }

        
        
        $stmt = $bdd->prepare('
             INSERT INTO utilisateur ( login, mdp, email)
                 VALUES (:login, :mdp, :email)');
         $stmt->bindValue(':login', $user['login'], PDO::PARAM_STR);
         $stmt->bindValue(':mdp', $user['mdp'], PDO::PARAM_STR);
         $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
         
         $res =  $stmt->execute();
         if ($res){
             $film['id'] = $bdd->lastInsertId();
            return true;
        }else {
            return false;
        }
    }
    
    
    public static function findByUser($login){
        $bdd = connectDB();
        $stmt = $bdd->prepare('SELECT * FROM utilisateur WHERE login = :login');
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $utilisateur = $stmt->fetch();
        
        return $utilisateur;
    }
}
