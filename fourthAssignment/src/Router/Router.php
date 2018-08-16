<?php

namespace Router;

class Router
{
    public $routes = [];

    public function registerRoute(string $route, string $function)
    {
        $this->routes[$route] = $function;
    }

    public function executeRedirect(string $route){

        $route = trim($route, '/');
        if ($route === '') {
            $route = 'movies';
        }
        $routePiecesToBeMatched = explode('/', $route);
        $routePieces = [];

        foreach ($routePiecesToBeMatched as $piece) {
            if (strpos($piece, '?')) {
                preg_match('/[^?]*/', $piece, $matches);
                $routePieces[] = $matches[0];
            } else {
                $routePieces[] = $piece;
            }
        }
        $route = implode('/',$routePieces);
        if (in_array('movies', $routePieces)) {
            (isset($_GET['page'])) ? $pageParamKey = $_GET['page'] : $pageParamKey = 1;
        }

        if (!isset($routePieces[0])) {
            // invalid
        }

        $controllerName = 'Controller' . '\\' . ucfirst(strtolower($routePieces[0])) . 'Controller';

        try {
            $reflection = new \ReflectionClass($controllerName);

            // return an instance
            $controller = $reflection->newInstance();

            $methodName = $this->routes[$routePieces[0]];

            if (is_null($methodName)) {
                $methodName = $routePieces[1];
            }

            if (is_null($methodName)) {
                return;
            }

            unset($routePieces[0]);

            // try finding out if the route includes an id
            $idParamKey = array_search('id', $routePieces);


            if ($idParamKey === false) {
                return (isset($pageParamKey)) ? $controller->{$methodName}($pageParamKey) : $controller->{$methodName}();
            }

            // the actual value of the id is the next route piece
            $idValueKey = $idParamKey + 1;

            if (!isset($routePieces[$idValueKey])) {
                return $controller->{$methodName}();
            }

            // get the id and pass it to the controller method
            $id = $routePieces[$idValueKey];
            return $controller->{$methodName}($id);
        } catch (\Exception $e) {

        }
    }


}