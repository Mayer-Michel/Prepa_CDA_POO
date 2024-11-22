<?php

// Chargement du sytéme d'autoload
require_once "../vendor/autoload.php";

// Déclaration des classes que l'on va utiliser dans le fichier 
use App\App;


$truc =  App::getApp();
$machin = clone $truc;

$truc -> toto( ' Truc a dit ' );
$truc -> toto( ' Et ensuite truc a dit ' );
$machin -> toto( ' Machin a dit ' );
var_dump($truc);
var_dump($machin);


// use App\App;
// use Dotenv\Dotenv;

// const DS = DIRECTORY_SEPARATOR;
// define( 'ROOT_PATH', dirname(__FILE__, 2) .DS );

// require_once ROOT_PATH. 'vendor/autoload.php';

// Dotenv::createImmutable( ROOT_PATH )->load();

// App::getApp()->start();

