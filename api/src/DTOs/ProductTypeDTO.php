<?php

namespace Fhtechnikum\Uebung34\DTOs;

class ProductTypeDTO
{
    public $productType;
    public $url;

    public static function map($productTypeModel, $url) {

        $productTypeDTO = new ProductTypeDTO();
        $productTypeDTO->productType = $productTypeModel->name;
        $productTypeDTO->url = $url . "?action=listProductsByTypeId&typeId=" . $productTypeModel->id;

        return $productTypeDTO;
    }
}