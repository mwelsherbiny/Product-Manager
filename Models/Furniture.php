<?php

namespace Models;

class Furniture extends Product
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
        return "Dimension: " . $this->attribute;
    }

    function getTypeId(): int
    {
        return 3;
    }
}