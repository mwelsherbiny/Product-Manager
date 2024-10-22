<?php

namespace Models;

class DVD extends Product
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
        return "Size: " . $this->attribute . " MB";
    }
}