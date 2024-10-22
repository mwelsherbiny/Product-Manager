<?php

namespace Core;

class Router
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
        $url = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method == "GET")
        {
            if (isset($this->getRoutes[$url]))
            {
                call_user_func($this->getRoutes[$url]);
            }
            else
            {
                echo "Page not found";
            }
        }
        else if ($method == "POST")
        {
            if (isset($this->postRoutes[$url]))
            {
                call_user_func($this->postRoutes[$url]);
            }
            else
            {
                echo "Page not found";
            }
        }
    }
}