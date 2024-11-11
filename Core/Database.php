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
            $product = ProductFactory::createProduct($info["type"], $info["sku"], $info["price"], $info["name"], $info["property"]);
            $stmt = $this->pdo->prepare("INSERT INTO product (sku, name, price, type_id, property) 
VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$product->getSku(), $product->getName(), $product->getPrice(), $product->getTypeId(), $product->getattribute()]);
        }
        return $errors;
    }

    public function getSKU()
    {
        return $this->pdo->query("SELECT sku FROM product");
    }
}