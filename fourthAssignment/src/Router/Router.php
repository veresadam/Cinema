<?php

class Router
{
    public static $routes = [];

    public static function setRoute($route, $function)
    {
        self::$routes[] = $route;

        print_r(self::$routes);
    }
}