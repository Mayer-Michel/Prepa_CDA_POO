<?php

namespace App\Controller;

use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;

class CategoryController extends Controller
{
    // Admin: Liste 
    public function index(): void
    {
        $view = new View( 'category:admin:list' );

        $data = [
            'title' => 'Liste des catégories',
            'categories' => RepoManager::getRM()->getCategoryRepo()->getAll()
        ];

        $view->render ( $data );
    }
}