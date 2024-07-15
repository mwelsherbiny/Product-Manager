<?php

namespace app;
require_once("Database.php");

if (isset($_POST))
{
    $request_body = file_get_contents('php://input');
    $data = (array)json_decode($request_body, true);
    $db = new Database();
    for ($i = 0; $i < count($data); $i++)
    {
        $db->deleteProduct($data[$i]);
    }
}