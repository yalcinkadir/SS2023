<?php

namespace SS2023\Gateways;

use SS2023\Models\ProductModel;
use SS2023\Models\ProductTypeModel;
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
        try {
            $pdo = new PDO('mysql:host=DBHost;dbname=DBName', 'DBUsername', 'DBPassword');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $pdo->query("SELECT 1");
            $result = $stmt->fetch();
        
            echo "Datenbankverbindung erfolgreich.";
        } catch (PDOException $e) {
            die("Verbindungsfehler: " . $e->getMessage());
        }
        
        
        
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
        $sql = "SELECT name, id FROM products 
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
            $productModel->id = $product->id;
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