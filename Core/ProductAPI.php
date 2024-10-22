<?php

namespace Core;

use Models\Product;

class ProductAPI
{
    static function deleteProduct(): void
    {
        $sku = explode("/api.php/products/", $_SERVER["REQUEST_URI"])[1];
        $db = new Database();

        if ($db->deleteProduct($sku)) {
            http_response_code(200);
            echo json_encode(["status" => 200, "message" => "Product deleted successfully: " . $sku]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => 500, "message" => "Error deleting product."]);
        }
    }

    static function addProduct() {

        $info = json_decode(file_get_contents('php://input'), true);

        $db = new Database();
        $errors = $db->addProduct($info);
        echo json_encode($errors);
    }
}