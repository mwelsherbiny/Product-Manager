<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\APIRouter;
use Core\ProductAPI;

$APIRouter = new APIRouter();
$APIRouter->addRoute("POST", "/products/delete/", [ProductAPI::class, "deleteProduct"]);
$APIRouter->addRoute("POST", "/products/add/", [ProductAPI::class, "addProduct"]);

$APIRouter->matchRoute();