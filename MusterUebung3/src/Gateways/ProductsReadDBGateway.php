<?php

namespace Fhtechnikum\Uebung34\Gateways;

use Fhtechnikum\Uebung34\Models\ProductModel;
use Fhtechnikum\Uebung34\Models\ProductTypeModel;
use PDO;

class ProductsReadDBGateway implements ProductsReadGatewayInterface
{
    private $pdo;

    public function __construct(
        $host,
        $dbname,
        $user,
        $password
    )
    {
        $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
    }

    public function getAllProductTypes()
    {
        $sql = "SELECT id, name FROM product_types ORDER BY name";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $productTypesList = $statement->fetchAll(PDO::FETCH_CLASS);

        return $this->mapProductTypes($productTypesList);
    }

    private function mapProductTypes(array $productTypesList)
    {
        $return = [];
        foreach ($productTypesList as $productType) {

            $productTypeModel = new ProductTypeModel();
            $productTypeModel->name = $productType->name;
            $productTypeModel->id = $productType->id;
            $return[] = $productTypeModel;
        }

        return $return;
    }

    public function getProductsByTypeId($productTypeId) {
        $sql = "SELECT name FROM products 
            WHERE id_product_types = :productTypeId";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':productTypeId', $productTypeId);
        $statement->execute();

        $productList = $statement->fetchAll(PDO::FETCH_CLASS);

        return $this->mapProduct($productList);
    }

    private function mapProduct(array $productList)
    {
        $return = [];
        foreach ($productList as $product) {
            $productModel = new ProductModel();
            $productModel->name = $product->name;
            $return[] = $productModel;
        }

        return $return;
    }

    public function getProductTypeName($productTypeId) {
        $sql = "SELECT name FROM product_types 
            WHERE id = :productTypeId";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':productTypeId', $productTypeId);
        $statement->execute();

        $productType = $statement->fetch(PDO::FETCH_OBJ);
        //valid result?
        return $productType->name;
    }

}