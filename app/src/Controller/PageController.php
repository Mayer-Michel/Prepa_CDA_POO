<?php

namespace App\Controller;

use Symplefony\View;

class PageController
{
    // Page d'accueil 
    public function index(): void
    {
        $view = new View( 'page:home' );

        $data = [
            'title' => 'Accueil - Autodingo'
        ];

        $view->render($data);
    }

    // Page mentions légales
    public function ML(): void
    {
        echo 'Mention légales depuis le controller ;)';
    }
}