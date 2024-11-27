<?php

namespace App\Controller;

use Symplefony\View;

use App\Model\UserModel;

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

         // Tests du UserModel (à supprimer après)
         $bdd = [
            'id' => 5,
            'password' => 'jeanmichel_securité',
            'email' => 'j.mitchell@hotmail.com',
            'firstname' => 'John',
            'lastname' => 'Mitchell',
            'phone_number' => '06 45 78 95 78'
        ];
        $jeanmich = new UserModel($bdd);
        var_dump( $jeanmich );
    }

    // Page mentions légales
    public function ML(): void
    {
        echo 'Mention légales depuis le controller ;)';
    }
}