<?php

namespace app;
require_once("Database.php");

$info = [
    "sku" => $_GET["sku"],
    "name" => $_GET["name"],
    "price" => $_GET["price"],
    "type" => $_GET["type"],
    "property" => $_GET["property"],
];

$db = new Database();
$errors = $db->addProduct($info);
echo json_encode($errors);
