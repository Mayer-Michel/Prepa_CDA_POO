<?php

// Chargement du sytéme d'autoload
require_once "../vendor/autoload.php";

use App\Controller\PageController;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

$router = Router::create();



$router->get( '/', [ PageController::class, 'index' ] );
$router->get( '/mentions-legales', [ PageController::class, 'ML']);

try{
    $router->dispatch();
}

// Page 404 avec status HTTP adequant les pages non listée dans le routeur 
catch( RouteNotFoundException $M ){
    http_response_code( 404 );
    echo 'Oups... YOU HAVE BEEN HACKED!!! ';
}
// Erreur 500 avec status HTTP adequant pour tout autre problème temporaire ou non 
catch( Throwable $M ){
    http_response_code( 500 );
    echo 'Erreur interne du serveur';
}
