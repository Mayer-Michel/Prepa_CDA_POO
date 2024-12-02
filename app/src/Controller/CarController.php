<?php

namespace App\Controller;

use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;

class CarController extends Controller
{
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
}