<?php

require_once __DIR__ . '/vendor/autoload.php';

use Controllers\ProductController;
use Core\Router;

$router = new Router();

$router->addRoute("GET", "/", [ProductController::class, "showProducts"]);
$router->addRoute("GET", "/add-product", [ProductController::class, "addProductView"]);

$router->matchRoute();