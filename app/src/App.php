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
    // - ? précise que la valeur peut qussi contenir null 
    private static ?self $app_instance = null;
    private string $last_message; 

    // Singleton etape 3: on crée un méthode publique statique qui permet d'obtenir l'instance unique
    public static function getApp(): self
    {
        // Si l'instance n'exite pas encore on la cée 
        if( is_null( self::$app_instance ) ){
            self::$app_instance = new self();
        }

        return self::$app_instance;
    }

    public function toto(string $msg): void
    {
        $this -> last_message = $msg;
        echo $msg. ' Je suis Toto !';
    }

    //Singleton etape 1: Bloquer l'utilisation de new depuis l'extérieur
    // => passer le constructeur en "private"
    private function __construct() { } 
    // Singleton etape 4: Bloquer l'utilisation de "clone" depuis l'exterieur 
    private function __clone() { }
}