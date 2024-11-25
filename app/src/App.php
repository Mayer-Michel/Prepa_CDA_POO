<?php
/**
 * Classe de démarrage de l'application 
 */

// Déclaration du namespace de ce fichier 
namespace App;

use Exception;
use Throwable;

use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;

use App\Controller\PageController;

final class App
{
    private static ?self $app_instance = null;
    
    // Le routeur de l'application
    private Router $router;

    public static function getApp(): self
    {
        // Si l'instance n'exite pas encore on la cée 
        if( is_null( self::$app_instance ) ){
            self::$app_instance = new self();
        }

        return self::$app_instance;
    }

    // Démarage de l'application
    public function start(): void
    {
        $this->registrationRoutes();
        $this->startRouter();
    }

    private function __construct() 
    { 
        // création du routeur
        $this->router = Router::create();
    } 

    private function registrationRoutes(): void
    {
        // Pages communes 
        $this->router->get( '/', [ PageController::class, 'index' ] );
        $this->router->get( '/mentions-legales', [ PageController::class, 'ML' ] );
    }

    // Démarrage du routeur 
    private function startRouter():void
    {
        try{
            $this->router->dispatch();
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
    }

    private function __clone() { }

    public function __wakeup()
    {
       throw new Exception("Non c'est interdit !");
    }
}