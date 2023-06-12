<?php

class ProductService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getProductTypes(): array
    {
        $productTypesData = $this->model->getProductTypes();
        $productTypes = [];

        foreach ($productTypesData as $productTypeData) {
            $productTypes[] = new ProductTypeDTO($productTypeData['name'], $productTypeData['url']);
        }

        return $productTypes;
    }


    public function getProductsByTypeId($typeId): array
    {
        $productsData = $this->model->getProductsByTypeId($typeId);
        $products = [];

        foreach ($productsData as $productData) {
            $products[] = new ProductDTO($productData['id'], $productData['name']);
        }

        return $products;
    }


}
