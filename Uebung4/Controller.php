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

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'defaultAction';

        switch ($action) {
            case 'listTypes':
                return $this->listTypes();
            case 'listProductsByTypeId':
                $typeId = $_GET['typeId'] ?? null;
                return $this->listProductsByTypeId($typeId);
            default:
                return $this->defaultAction();
        }
    }
}