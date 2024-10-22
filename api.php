<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\APIRouter;
use Core\ProductAPI;

$APIRouter = new APIRouter("products");
$APIRouter->addRoute("DELETE", [ProductAPI::class, "deleteProduct"]);
$APIRouter->addRoute("POST", [ProductAPI::class, "addProduct"]);

$APIRouter->matchRoute();