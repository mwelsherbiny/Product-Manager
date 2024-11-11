<?php

namespace Models;

use Exception;

class ProductFactory {
    /**
     * @throws Exception
     */
    public static function createProduct($type, $sku, $price, $name, $attribute) : Product {
        return match (strtolower($type)) {
            'book' => new Book($sku, $price, $name, $attribute),
            'dvd' => new DVD($sku, $price, $name, $attribute),
            'furniture' => new Furniture($sku, $price, $name, $attribute),
            default => throw new Exception("Invalid product type: " . $type),
        };
    }
}