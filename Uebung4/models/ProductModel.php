<?php

require_once 'database/DatabaseGateway.php';

class ProductModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = new DatabaseGateway($db->getConnection());
    }

    public function getProductTypes(): array
    {
        $result = $this->db->getProductTypes();

        $productTypes = [];
        foreach ($result as $row) {
            $productTypes[] = [
                "name" => $row['name'],
                "url" => "http://localhost/Uebung4/index.php?action=listProductsByTypeId&typeId={$row['id']}"
            ];
        }
        return $productTypes;
    }

    public function getProductsByTypeId($productTypeId): array
    {
        $result = $this->db->getProductsByTypeId($productTypeId);

        $products = [];
        foreach ($result as $row) {
            $product = [
                'id' => $row['productId'],
                'name' => $row['productName']
            ];
            $products[] = $product;
        }

        if (!empty($result)) {
            $output = [
                'productType' => $result[0]['productTypeName'],
                'products' => $products,
                'url' => "http://localhost/Uebung4/index.php?action=listTypes"
            ];
        } else {
            $output = [
                'error' => 'No products found for the given typeId',
                'url' => "http://localhost/Uebung4/index.php?action=listTypes"
            ];
        }
        return $output;
    }

    public function getProductById($productId): array
    {
        $result = $this->db->getProductById($productId);

        if (!empty($result)) {
            return ['name' => $result[0]['name']];
        } else {
            return null;
        }
    }

}
