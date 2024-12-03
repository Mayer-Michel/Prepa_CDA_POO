<?php

namespace App\Controller;

use App\Model\Entity\Car;
use App\Model\Repository\RepoManager;
use Laminas\Diactoros\ServerRequest;
use Symplefony\Controller;
use Symplefony\View;

class CarController extends Controller
{

     /**
     * Pages Administrateur
     */

    // Admin: Affichage du formulaire de création d'un utilisateur
    public function add(): void
    {
        $view = new View( 'car:admin:create' );

        $data = [
            'title' => 'Ajouter une voiture'
        ];

        $view->render( $data );
    }

    // Admin: Traitement du formulaire de création d'une catégorie
    public function create( ServerRequest $request ): void
    {
        $car_data = $request->getParsedBody();

        $car = new Car( $car_data );

        $car_created = RepoManager::getRM()->getCarRepo()->create( $car );

        if( is_null( $car_created ) ) {
            // TODO: gérer une erreur
            $this->redirect( '/admin/cars/add' );
        }

        $this->redirect( '/admin/cars' );
    }

    // Admin: Liste 
    public function index(): void
    {
        $view = new View( 'car:admin:list' );

        $data = [
            'title' => 'Liste des voitures',
            'cars' => RepoManager::getRM()->getCarRepo()->getAll()
        ];

        $view->render ( $data );
    }

    // Admin: Affichage détail/modification
    public function show( int $id ): void
    {
        $view = new View( 'car:admin:details' );

        $car = RepoManager::getRM()->getCarRepo()->getById( $id );

        // Si l'utilisateur demandé n'existe pas
        if( is_null( $car ) ) {
            View::renderError( 404 );
            return;
        }

        $data = [
            'title' => 'Categorie: '. $car->getLabel(),
            'car' => $car
        ];

        $view->render( $data );
    }

    // Admin: Traitement du formulaire de modification
    public function update( ServerRequest $request, int $id ): void
    {
        $car_data = $request->getParsedBody();

        $car = new Car( $car_data );
        $car->setId( $id );

        $car_updated = RepoManager::getRM()->getCarRepo()->update( $car );

        if( is_null( $car_updated ) ) {
            // TODO: gérer une erreur
            $this->redirect( '/admin/cars/'. $id );
        }

        $this->redirect( '/admin/cars' );
    }

    // Admin: Suppression
    public function delete( int $id ): void
    {
        $delete_success = RepoManager::getRM()->getCarRepo()->deleteOne( $id );

        if( ! $delete_success ) {
            // TODO: gérer une erreur
            $this->redirect( '/admin/cars/'. $id );
        }

        $this->redirect( '/admin/cars' );
    }

}