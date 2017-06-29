<?php

namespace AfpaBay;

//auto chargement des dépendances, /vendor/autoload.php est un fichier généré par composer lors de l'import d'une nouvelle librairie ( composer require ...)
require __DIR__ . '/../vendor/autoload.php';

use \Phroute\Phroute\RouteCollector;


session_start();


$router = new RouteCollector();

$router->filter('auth', function(){
    if(!isset($_SESSION['user_id'])) 
    {
        return http_response_code(403);
    }
});

$router->get('/', ['AfpaBay\Controllers\FilmController', 'indexAction']);
$router->get('/film', ['AfpaBay\Controllers\FilmController', 'indexAction']);
$router->post('/film', ['AfpaBay\Controllers\FilmController', 'createAction']);
$router->get('/film/new', ['AfpaBay\Controllers\FilmController', 'newAction']);

$router->get('/login', ['AfpaBay\Controllers\LoginController', 'indexAction']);
$router->post('/login', ['AfpaBay\Controllers\LoginController', 'authAction']);
$router->get('/logout', ['AfpaBay\Controllers\LoginController', 'logoutAction']);


$router->get('/register', ['AfpaBay\Controllers\LoginController', 'registerNewAction']);
$router->post('/register', ['AfpaBay\Controllers\LoginController', 'registerCreateAction']);

$router->group(['before'=>'auth'], function($router){
    
    $router->post('/film/{id}', ['AfpaBay\Controllers\FilmController', 'updateAction']);
    
});



$dispatcher = new \Phroute\Phroute\Dispatcher($router->getData());
$content = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    
include(dirname(__FILE__).'/../src/templates/main.php');


