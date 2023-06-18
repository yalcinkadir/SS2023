<?php

namespace MusterUebung3\src\DTOs;

class ProductDTO
{
    public $name;

    public static function map($productModel) {

        $dto = new ProductDTO();
        $dto->name = $productModel->name;

        return $dto;
    }
}