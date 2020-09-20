<?php

namespace App;

use AltoRouter;
use App\Security\ForbiddenException;

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
     * Récupérer les infos de l'url en POST puis renvoie l'objet router afin d'enchainer les méthodes.
     *
     * @param  string $url
     * @param  string $view
     * @param  string-null  $name
     * @return Router
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }

    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }
    
    
    /**
     * Renome $router->generate en $router->url
     *
     * @param  string $name
     * @param  array $params
     * @return $router->generate
     */
    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    /**
     * Compare les données du router et ceux de l'url, définit la vue dans laquelle se trouve l'url
     * !Bug du router lors d'une redirection 404...
     * @return Router
     */
    public function run(): self
    {
        $match = $this->router->match();
        $view = $match['target'] ?: 'e404';
        $params = $match['params'];
        $router = $this;
        $isAdmin = strpos($view, 'admin/') !== false;
        $layout = $isAdmin ? 'admin/layouts/default' : 'layouts/default';
        try {
            ob_start();
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . $layout . '.php';
        } catch (ForbiddenException $e) {
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }

        return $this;
    }




}