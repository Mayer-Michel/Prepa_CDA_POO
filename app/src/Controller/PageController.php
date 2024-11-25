<?php

namespace App\Controller;

class PageController
{
    // Page d'accueil 
    public function index(): void
    {
        echo 'Bonjour depuis le controller ;)';
    }

    // Page mentions légales
    public function ML(): void
    {
        echo 'Mention légales depuis le controller ;)';
    }
}