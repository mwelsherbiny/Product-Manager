<?php

namespace app;
use app\Controller\ProductController;
require "Router.php";
require "Controller/ProductController.php";

$router = new Router();

$router->addRoute("GET", "/", [ProductController::class, "renderProductList"]);
$router->addRoute("GET", "/add-product", [ProductController::class, "renderAddProduct"]);

$router->matchRoute();