<?php

namespace Models;

class Book extends Product
{
    function __construct($sku, $price, $name, $attribute)
    {
        $this->setSku($sku);
        $this->setPrice($price);
        $this->setName($name);
        $this->setAttribute($attribute);
    }

    function getAttributeString(): string
    {
        return "Weight: " . $this->attribute . "KG";
    }

    function getTypeId(): int
    {
        return 2;
    }
}