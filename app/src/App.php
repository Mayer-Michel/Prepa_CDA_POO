<?php
/**
 * Classe de démarrage de l'application 
 */

// Déclaration du namespace de ce fichier 
namespace App;

class App
{
    // Singleto  etape 2: on crée une propriété statique pour stocker l'instance unique 
    // "?self" : 
    // - self représente le type de la class dans laquelle in est (ici = App)
    
    private static ?self $app_instance = null;
    private string $last_message; 

    public function toto(string $msg): void
    {
        $this -> last_message = $msg;
        echo $msg. ' Je suis Toto !';
    }

    //Singleton etape 1 : Bloquer l'utilisation de new depuis l'extérieur
    // => passer le constructeur en "private"
    private function __construct() { } 
}