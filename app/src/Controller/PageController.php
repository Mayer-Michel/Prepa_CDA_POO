<?php

namespace App\Controller;

use Symplefony\View;

use PDO;

use App\Model\UserModel;
use Symplefony\Controller;
use Symplefony\Database;

class PageController extends Controller
{
    // Page d'accueil 
    public function index(): void
    {
        $view = new View( 'page:home' );

        $data = [
            'title' => 'Accueil - Autocasse'
        ];

        $view->render($data);

        }

    // Page mentions légales
    public function ML(): void
    {
        echo 'Mention légales depuis le controller ;)';

        // Test de create (à supprimer)
        $data = [
            'password' => '1234',
            'email' => 'toto@email.com',
            'firstname' => 'Big',
            'lastname' => 'Boss',
            'phone_number' => '0783962269'
        ];

        $user = new UserModel( $data );
        $new_user = userModel::create( $user );
        $user_id = userModel::getById( 14 );
        var_dump( $user_id );
        var_dump( $new_user );
    }
}