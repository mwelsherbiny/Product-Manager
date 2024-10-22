<?php

namespace Core;

class APIRouter
{
    private array $getRoutes;
    private array $postRoutes;

    public function addRoute($method, $url, $target)
    {
        if ($method == "GET")
        {
            $this->getRoutes[$url] = $target;
        }
        else if ($method == "POST")
        {
            $this->postRoutes[$url] = $target;
        }
    }

    public function matchRoute()
    {
        $url = explode("/api.php", $_SERVER["REQUEST_URI"])[1];
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "GET")
        {
            if (isset($this->getRoutes[$url]))
            {
                call_user_func($this->getRoutes[$url]);
            }
            else {
                echo json_encode(["error" => "Route not found"]);
            }
        }
        else if ($method == "POST")
        {
            if (str_contains($url, "/products/delete")) {
                call_user_func($this->postRoutes["/products/delete/"]);
            }
            else if (isset($this->postRoutes[$url]))
            {
                call_user_func($this->postRoutes[$url]);
            }
            else {
                echo json_encode(["error" => "Route not found"]);
            }
        }
    }
}