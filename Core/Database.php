<?php

namespace Core;

use Exception;
use Models\Product;
use Models\ProductFactory;
use PDO;

require ("config.php");

class Database
{
    private PDO $pdo;
    private string $user = DBUSER;
    private string $host = DBHOST;
    private string $pass = DBPWD;
    private string $name = DBNAME;

    function __construct()
    {
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->name", $this->user, $this->pass);
    }

    public function getProducts() : array
    {
        $products = [];
        $sql = $this->pdo->query("SELECT sku, name, price, property, type_name FROM product
JOIN type ON product.type_id = type.type_id");

        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            try {
                $product = ProductFactory::createProduct($row["type_name"], $row["sku"], $row["price"], $row["name"], $row["property"]);
            }
            catch (Exception) {
                error_log("Invalid product");
                continue;
            }
            $products[] = $product;
        }
        return $products;
    }

    public function deleteProduct($sku): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM product WHERE sku = ?");
        return $stmt->execute([$sku]);
    }

    public function addProduct($info): array
    {
        $errors = Product::validateInfo($info);
        if (sizeof($errors) == 0)
        {
            $typeId = $this->getTypeId($info["type"]);
            $stmt = $this->pdo->prepare("INSERT INTO product (sku, name, price, type_id, property) 
VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$info["sku"], $info["name"], $info["price"], $typeId, $info["property"]]);
        }
        return $errors;
    }

    private function getTypeId($type): int
    {
        if ($type == "DVD")
        {
            return 1;
        }
        else if ($type == "Book")
        {
            return 2;
        }
        else if ($type == "Furniture")
        {
            return 3;
        }
        return -1;
    }

    public function getSKU()
    {
        return $this->pdo->query("SELECT sku FROM product");
    }
}