<?php

class Controller
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function listTypes()
    {
        return $this->model->getProductTypes();
    }

    public function listProductsByTypeId($typeId)
    {
        return $this->model->getProductsByTypeId($typeId);
    }
}