<?php

namespace Controllers;

use Core\Database;

class ProductController
{
    static function showProducts(): void
    {
        $db = new Database();
        $products = $db->getProducts();
        require "Views" . DIRECTORY_SEPARATOR . "products.php";
    }

    static function addProductView(): void
    {
        require "Views" . DIRECTORY_SEPARATOR . "addProduct.php";
    }
}