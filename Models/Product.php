<?php

namespace Models;

use Core\Database;
use PDO;

abstract class Product
{
    protected mixed $sku;
    protected mixed $price;
    public mixed $name;
    protected mixed $attribute;

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $attribute
     */
    public function setAttribute($attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return mixed
     */
    public function getSku(): mixed
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice(): mixed
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getattribute(): mixed
    {
        return $this->attribute;
    }

    public function getPriceString(): string
    {
        return $this->getPrice() . " $";
    }

    abstract public function getAttributeString();

    static function validateInfo($info): array
    {
        $errors = self::isFilled($info);

        if ($errors) {
            $errors["empty"] = "Please, submit required data";
        }

        if (!isset($errors["sku"]) && !self::isSKUValid($info["sku"])) {
            $errors["sku"] = "SKU must be unique";
        }

        if (!isset($errors["price"]) && !self::isPriceValid($info["price"])) {
            $errors["price"] = "Please, provide the data of indicated type";
        }

        return $errors;
    }

    private static function isSKUValid($sku): bool
    {
        $db = new Database();
        $sql = $db->getSKU();

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            if ($row["sku"] == $sku) {
                return false;
            }
        }

        return true;
    }

    private static function isPriceValid($price): bool
    {
        if (!is_numeric($price) || $price < 0) {
            return false;
        }

        return true;
    }

    static function isFilled($info): array
    {
        $fields = array_keys($info);
        $errors = [];

        foreach ($fields as $field) {
            if (strlen($info[$field]) == 0) {
                $errors[$field] = "Please enter " . $field;
            }
        }

        return $errors;
    }
}