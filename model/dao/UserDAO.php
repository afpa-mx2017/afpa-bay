<?php
include('DBConnect.php');
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
   
    
    public static function save($user){
        $bdd = connectDB();
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
}
