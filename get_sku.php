<?php
namespace app;
require_once("Database.php");

$db = new Database();
echo $db->getSKUJSON();