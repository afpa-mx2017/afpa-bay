<?php
namespace AfpaBay\Controllers;

use Mustache_Engine;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author lionel
 */
class Controller {
    public function __construct() {
        $options =  array('extension' => '.tpl');
        $this->template = new Mustache_Engine(array(
           'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__FILE__) .'/../templates', $options)
        ));
    }
    
    public function getCurrentUser(){
        return $_SESSION['user_id'];
    }
    
    public function isLogged(){
        return isset($_SESSION['user_id']);
    }
}
