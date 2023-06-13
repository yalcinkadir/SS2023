<?php

namespace Fhtechnikum\Uebung34\Services;

class ProductsService
{
    private $productsReadGateway;

    public function __construct($productsReadGateway)
    {
        $this->productsReadGateway = $productsReadGateway;
    }


    public function getAllProductTypes()
    {
        $productModelList = $this->productsReadGateway->getAllProductTypes();
        return $productModelList;
    }

    public function getProductsByTypeId($productTypeId)
    {
        $productList = $this->productsReadGateway->getProductsByTypeId($productTypeId);
        return $productList;
    }

    public function getProductTypeName($productTypeId)
    {
        $productTypeName = $this->productsReadGateway->getProductTypeName($productTypeId);
        return $productTypeName;
    }
}