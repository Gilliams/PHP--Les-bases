<?php

namespace App;

use AltoRouter;

class Router{

    /**
     * @var string
     */
    private $viewPath;
    
    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    
    /**
     * Récupérer les infos de l'url en GET puis renvoie l'objet router afin d'enchainer les méthodes.
     *
     * @param  string $url
     * @param  string $view
     * @param  string-null  $name
     * @return Router
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }
    
    /**
     * Compare les données du router et ceux de l'url, définit la vue dans laquelle se trouve l'url
     *
     * @return Router
     */
    public function run(): self
    {
        $match = $this->router->match();
        $view = $match['target'];
        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
        return $this;
    }




}