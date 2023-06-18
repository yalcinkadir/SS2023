<?php

namespace Fhtechnikum\Uebung34\DTOs;

class ProductDTO
{
    public $name;
    public $id;

    public static function map($productModel) {

        $dto = new ProductDTO();
        $dto->name = $productModel->name;
        $dto->id = $productModel->id;

        return $dto;
    }
}