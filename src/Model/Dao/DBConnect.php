<?php

include_once('config.inc.php');

function connectDB(){
    try{
        $bdd = new \PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    
    return $bdd;
}

