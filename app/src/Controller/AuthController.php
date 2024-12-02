<?php

namespace App\Controller;

use Symplefony\Controller;

class AuthController extends Controller
{
    public static function isAdmin(): bool
    {
        // TODO: Le vrai contrôle de session
        return true;
    }
    
}