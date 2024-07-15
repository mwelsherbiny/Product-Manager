<?php

namespace app\Controller;

use app\Database;
require ("Database.php");

class ProductController
{
    public static function renderProductList()
    {
        $db = new Database();
        $productsInfo = $db->getProductsInfo();
        require_once("Views/product-list.php");
    }

    public static function renderAddProduct()
    {
        $db = new Database();
        $db->getSKU();
        require_once("Views/add-product.php");
    }
}