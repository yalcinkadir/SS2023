<?php

class DatabaseGateway
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductTypes()
    {
        $sql = 'SELECT id, name FROM product_types ORDER BY name';
        return $this->executeQuery($sql);
    }

    private function executeQuery($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByTypeId($productTypeId)
    {
        $sql = 'SELECT p.id AS productId, t.name AS productTypeName, p.name AS productName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = :productTypeId';
        return $this->executeQuery($sql, [':productTypeId' => $productTypeId]);
    }

    public function getProductById($productId)
    {
        $sql = 'SELECT name FROM products WHERE id = :productId';
        return $this->executeQuery($sql, [':productId' => $productId]);
    }
}
