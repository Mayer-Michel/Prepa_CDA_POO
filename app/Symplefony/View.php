<?php

namespace Symplefony;

class View
{
    public const VIEW_PATH = APP_PATH .'views'. DS;
    public const COMMON_PATH = self::VIEW_PATH .'_common'. DS;

    private string $name;
    /**
     * Constructeur 
     * @param string $name Nom de la vue (construction  représentant le chemin)
     * @return View Instance 
     */

    public function __construct( string $name )
    {
        $this->name = $name;
        
    }

    public function render(array $view_data = [] ): void
    {
        require_once self::COMMON_PATH .'top.phtml';

        require_once $this->getTemplatePath();

        require_once self::COMMON_PATH .'bottom.phtml'; 
    }

    private function getTemplatePath(): string 
    {
        // Chemin ici: /var/www/html/app/src/views/page/home.phtml
        $path = self::VIEW_PATH .'page'. DS .'home.phtml';

         // On remplace tous les ":" de $this->name par des séparateurs de dossiers (DS)
         $path = str_replace( ':', DS, $this->name );

         // On ajoute avant et après le reste du chemin final
         $path = self::VIEW_PATH . $path .'.phtml';

        return $path;
    }
}