<?php

class DatabaseGateway
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function executeQuery($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
