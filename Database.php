<?php

namespace app;
require ("Models/Book.php");
require ("Models/DVD.php");
require ("Models/Furniture.php");
include ("config.php");

use app\Models\Product;
use PDO;

class Database
{
    private $pdo;
    private $user = DBUSER;
    private $host = DBHOST;
    private $pass = DBPWD;
    private $name = DBNAME;

    function __construct()
    {
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->name", $this->user, $this->pass);
    }

    public function getProductsInfo()
    {
        $productsInfo = [];
        $sql = $this->pdo->query("SELECT sku, name, price, property, type_name FROM product
JOIN type ON product.type_id = type.type_id");
        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $row["property"] = $this->getCompleteProperty($row["property"], $row["type_name"]);
            $productsInfo[] = $row;
        }
        return $productsInfo;
    }

    private function getCompleteProperty($property, $type)
    {
        switch ($type)
        {
            case "DVD":
                return "Size: " . $property . " MB";
            case "book":
                return "Weight: " . $property . "KG";
            case "furniture":
                return "Dimensions: " . $property;
        }
        return "property";
    }

    public function deleteProduct($sku)
    {
        $stmt = $this->pdo->prepare("DELETE FROM product WHERE sku = ?");
        $stmt->execute([$sku]);
    }

    public function addProduct($info)
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

    private function getTypeId($type)
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

    public function getSKUJSON()
    {
        $sql = $this->pdo->query("SELECT sku FROM product");
        return json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
    }
}