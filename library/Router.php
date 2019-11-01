<?php

class Router
{
    private $routes;

    public function __construct(Configuration $configuration)
    {
        $this->routes = $configuration->get('routes', 'routes', []);
    }

    public function getController()
    {
        if (isset($_SERVER['PATH_INFO']) == false || $_SERVER['PATH_INFO'] == '/') {
            $requestPath = "";
        } else {
            $requestPath = strtolower($_SERVER['PATH_INFO']);
        }
        foreach ($this->routes as $route) {
            if ($route['path'] === $requestPath) {
                return $route['controller'];
            }
        }
        throw new ErrorException
        (
            "Aucune route configurée pour le chemin : <strong>$requestPath</strong>"
        );
    }
}