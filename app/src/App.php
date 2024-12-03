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
use MiladRahimi\PhpRouter\Routing\Attributes;

use Symplefony\View;

use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Controller\CarController;
use App\Controller\CategoryController;
use App\Controller\PageController;
use App\Controller\UserController;
use App\Middleware\AdminMiddleware;

final class App
{
    private static ?self $app_instance = null;
    
    // Le routeur de l'application
    private Router $router;
    public function getRouter(): Router { return $this->router; }

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

    // Enregistrement des routes de l'application
    private function registrationRoutes(): void
    {
        // Formats des paramètres
        $this->router->pattern( 'id', '[0-9]+' );

        // -- Pages communes --
        $this->router->get( '/', [ PageController::class, 'index' ] );
        $this->router->get( '/mentions-legales', [ PageController::class, 'ML' ] );

        // TODO: Groupe Visiteurs (nom-connectés)

        // -- Pages d'admin --
        $adminAttributes = [
            Attributes::PREFIX => '/admin',
            Attributes::MIDDLEWARE => [ AdminMiddleware::class ]
        ];

        $this->router->group( $adminAttributes, function( Router $router ) {
            $router->get( '', [ AdminController::class, 'dashboard' ]);
            
            // -- User --
            // Ajout
            $router->get( '/users/add', [ UserController::class, 'add' ]);
            $router->post( '/users', [ UserController::class, 'create' ]);

            // Liste
            $router->get( '/users', [ UserController::class, 'index' ]);

            // Détail
            $router->get( '/users/{id}', [ UserController::class, 'show' ]);

            // -- Category --
            // Ajout
            $router->get( '/categories/add', [ CategoryController::class, 'add' ] );
            $router->post( '/categories', [ CategoryController::class, 'create' ] );
            // Liste
            $router->get( '/categories', [ CategoryController::class, 'index' ]);
            // Détail/modification
            $router->get( '/categories/{id}', [ CategoryController::class, 'show' ] );
            $router->post( '/categories/{id}', [ CategoryController::class, 'update' ] );
            // Suppression
            $router->get( '/categories/{id}/delete', [ CategoryController::class, 'delete' ] );

            // -- car --
            // Liste
            $router->get( '/cars', [CarController::class, 'index' ]);
        });
    }

    // Démarrage du routeur 
    private function startRouter():void
    {
        try{
            $this->router->dispatch();
        }
        
        // Page 404 avec status HTTP adequant les pages non listée dans le routeur 
        catch( RouteNotFoundException $M ){
            View::renderError( 404 );
        }
        // Erreur 500 avec status HTTP adequant pour tout autre problème temporaire ou non 
        catch( Throwable $M ){
            View::renderError( 500 );
            var_dump( $M );
        }
    }

    private function __clone() { }

    public function __wakeup()
    {
       throw new Exception("Non c'est interdit !");
    }
}