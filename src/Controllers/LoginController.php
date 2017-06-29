<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AfpaBay\Controllers;


use AfpaBay\Model\Dao\UserDAO;
use AfpaBay\Exceptions\AlreadyExistException;
/**
 * Description of LoginController
 *
 * @author lionel
 */
class LoginController extends Controller{
    
    public function indexAction(){
        return $this->template->render('login');
    }
    
    public function logoutAction(){
        session_destroy();
        header('Location: /');
    }
    
    
    public function authAction(){

        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);


        if (!($login && $mdp)){
            return $this->template-render('login', array("error"=> "humm bah si tu saisi pas ton login +mdp comment je peux savoir si tu es membre ?"));
        }
        
        

        $utilisateur = UserDAO::findByUser($login);
        if (!$utilisateur){
            return $this->template->render('login', array("error"=> "humm, pas trouvé d'utilisateur $login"));
        }
        
        if (!password_verify($mdp, $utilisateur['mdp'])){
            return $this->template->render('login', array("error"=> "humm, le mot de passe est pas bon"));
        }else{
           //ça semble ok, on mlet des choses dans la variable de session et on redirige vers la page d'accueil
           $_SESSION['user_id'] = $utilisateur['id'];
           $_SESSION['current_user'] = $utilisateur['login'];
           //on redirige
           header("Location: /");
       }






    }
    
    
    public function registerNewAction(){
        return $this->template->render('register-form');
    }
    
    public function registerCreateAction(){
        
        
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $mdp_verif = filter_input(INPUT_POST, 'mdp_verif', FILTER_SANITIZE_STRING);
        $email  = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


        $errorMsg = "";
        //test champs obligatoires:
        if (!($login && $mdp && $mdp_verif && $email)){
            $errorMsg = "tous les champs sont obligatoires per favore";
        }


        if (!$email){
            $errorMsg = "sur sur que vous avez saisie une adresse email valide ?";
        }

        if ($mdp != $mdp_verif){
            $errorMsg = "humm, ptit soucis en retapant le mdp ?";
        }

        if (!empty($errorMsg)){
            return $this->template->render('register-form', array("error"=> ".$errorMsg."));
        }

        $user = array("login" => $login, "mdp" => password_hash($mdp, PASSWORD_BCRYPT), "email"=> $email);
        try {
            $res = UserDAO::save($user);
            if ($res) {
                return $this->template->render('login', array("success"=> "cool votre compte à été créé, merci de vous authentifier"));

            }else{
                return $this->template->render('register-form', array("error"=> "oulala ya un soucis coté bdd"));
            }
        } catch (AlreadyExistException $exc) {
            return $this->template->render('register-form', array("error"=> "mais ché déjà pris ce login boudiou!"));
        }
    }
}
