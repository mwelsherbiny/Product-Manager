<?php

namespace Core;

class ProductAPI
{
    static function deleteProduct(): void
    {

        $sku = explode("/api.php/products/delete/", $_SERVER["REQUEST_URI"])[1];
        $db = new Database();

        if ($db->deleteProduct($sku)) {
            http_response_code(200);
            echo json_encode(["status" => 200, "message" => "Product deleted successfully: " . $sku]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => 500, "message" => "Error deleting product."]);
        }
    }

    static function addProduct(): void
    {
        $info = json_decode(file_get_contents('php://input'), true);

        $db = new Database();
        $errors = $db->addProduct($info);
        echo json_encode($errors);
    }
}