<?php
namespace App\Controller;
use Symplefony\View;
class AdminController
{
    // Dashboard
    public function dashboard(): void
    {
        $view = new View( 'page:admin:home' );
        $view->render();
    }
}