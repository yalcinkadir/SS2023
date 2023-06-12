<?php

class ProductService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getProductTypes()
    {
        return $this->model->getProductTypes();
    }

    public function getProductsByTypeId($typeId)
    {
        return $this->model->getProductsByTypeId($typeId);
    }

}
