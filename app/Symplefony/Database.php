<?php

namespace Symplefony;

use Exception;
use PDO;

class Database
{
    private const PDO_OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    //Singleton etape 1: Bloquer l'utilisation de new depuis l'extérieur
    // => passer le constructeur en "private"
    private function __construct() { } 

    // Singleto  etape 2: on crée une propriété statique pour stocker l'instance unique 
    // "?self" : 
    // - self représente le type de la class dans laquelle in est (ici = App)
    // - ? précise que la valeur peut qussi contenir null
    private static ?PDO $pdo_instance = null;

    // Singleton etape 3: on crée un méthode publique statique qui permet d'obtenir l'instance unique
    public static function getPDO(): PDO
    {
        // Si l'instance n'exite pas encore on la cée 
        if( is_null( self::$pdo_instance ) ){
            $dsn = sprintf( 'mysql:host=%s;dbname=%s', $_ENV['db_host'], $_ENV['db_name'] );

            self::$pdo_instance = new PDO( $dsn, $_ENV['db_user'], $_ENV['db_pass'], self::PDO_OPTIONS );
        }

        return self::$pdo_instance;
    }

    // Singleton etape 4: Bloquer l'utilisation de "clone" depuis l'exterieur 
    private function __clone() { }
    // Singleton etape 5: Bloquer la désérialisation de l'objet (depuis la session par exemple)
    // "private" est interdit pour ce cas, on va donc lui faire lancer une erreur
    public function __wakeup()
    {
       throw new Exception("Non c'est interdit !");
    }
}