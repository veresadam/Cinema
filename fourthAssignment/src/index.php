<?php

declare(strict_types=1);
require_once "../vendor/autoload.php";

use Router\Router;

$router = new Router;

$router->registerRoute('user', 'showFormAction');

$router->registerRoute('user', 'showFormAction');

$router->registerRoute('movies', "showMoviesAction");

$router->registerRoute('', "showMoviesAction");

$router->registerRoute('reservation', "chooseScreeningAction");

$router->executeRedirect($_SERVER['REQUEST_URI']);
