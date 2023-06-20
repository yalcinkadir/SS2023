<?php

namespace SS2023\Controller;

use SS2023\DTOs\ProductDTO;
use SS2023\DTOs\ProductListDTO;
use SS2023\DTOs\ProductTypeDTO;
use SS2023\Gateways\ProductsReadDBGateway;
use SS2023\Services\ProductsService;
use SS2023\Views\JsonView;
use SS2023\config\Config;

class ProductsListController
{

    private $service;
    private $jsonView;
    private $url = API_URL;

    public function __construct()
    {
        $gateway = new ProductsReadDBGateway(
            DBHost,
            DBName,
            DBUsername,
            DBPassword
        );
        $this->service = new ProductsService($gateway);
        $this->jsonView = new JsonView();
    }

    public function route()
    {
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        switch(strtolower($action)) {
            case 'listtypes': //list product types
                $this->listProductTypes();
                break;
            case 'listproductsbytypeid': //list products by type id
                $productTypeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_NUMBER_INT);
                if(!$productTypeId) {
                    return $this->error("Invalid Type Id");
                }
                $this->listProductsByTypeId($productTypeId);
                break;
            default:
                $this->error("Unknown Action");
        }
    }

    private function listProductTypes()
    {
        $productTypesList = $this->service->getAllProductTypes();
        $dtoList = [];
        foreach($productTypesList as $item) {
            $dtoList[] = ProductTypeDTO::map($item, $this->url);
        }

        $this->jsonView->display($dtoList);
    }

    private function listProductsByTypeId($productTypeId)
    {
        $productsList = $this->service->getProductsByTypeId($productTypeId);
        $productTypeName = $this->service->getProductTypeName($productTypeId);
        $dtoList = [];
        foreach($productsList as $item) {
            $dtoList[] = ProductDTO::map($item);
        }

        $response = new ProductListDTO();
        $response->productType = $productTypeName;
        $response->products = $dtoList;
        $response->url = $this->url . "?action=listTypes";

        $this->jsonView->display($response);
    }

    private function error($errorMessage)
    {
        //display via view ... the error
        print ($errorMessage);
    }
}