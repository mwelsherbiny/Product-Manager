<?php

namespace Core;

class APIRouter
{
    private array $getRoutes;
    private array $postRoutes;
    private array $deleteRouters;
    private string $url;

    public function __construct($apiName) {
        $this->url = "/" . $apiName;
    }


    public function addRoute($method, $target) : void
    {
        if ($method == "GET")
        {
            $this->getRoutes[$this->url] = $target;
        }
        else if ($method == "POST")
        {
            $this->postRoutes[$this->url] = $target;
        }
        else if ($method == "DELETE") {
            $this->deleteRouters[$this->url] = $target;
        }
    }

    public function matchRoute() : void
    {
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "GET")
        {
            if (isset($this->getRoutes[$this->url]))
            {
                call_user_func($this->getRoutes[$this->url]);
            }
        }
        else if ($method == "POST")
        {
            if (isset($this->postRoutes[$this->url]))
            {
                call_user_func($this->postRoutes[$this->url]);
            }
        }
        else if ($method == "DELETE")
        {
            if (isset($this->deleteRouters[$this->url]))
            {
                call_user_func($this->deleteRouters[$this->url]);
            }
        }
    }
}