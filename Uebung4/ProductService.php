<?php

class ProductService
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getProductTypes()
    {
        $result = $this->db->executeQuery('SELECT id, name FROM product_types ORDER BY name');

        $productTypes = [];
        foreach ($result as $row) {
            $productTypes[] = [
                "name" => $row['name'],
                "url" => "http://localhost/Uebung4/index.php?action=listProductsByTypeId&typeId={$row['id']}"
            ];
        }
        return $productTypes;
    }

    public function getProductsByTypeId($productTypeId)
    {
        $result = $this->db->executeQuery('SELECT p.id AS productId, t.name AS productTypeName, p.name AS productName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = :productTypeId', [':productTypeId' => $productTypeId]);

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

    public function getProductById($productId)
    {
        $result = $this->db->executeQuery('SELECT name FROM products WHERE id = :productId', [':productId' => $productId]);

        if (!empty($result)) {
            return ['name' => $result[0]['name']];
        } else {
            return null;
        }
    }

}
