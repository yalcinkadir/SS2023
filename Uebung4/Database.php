<?php

class Database
{
    private $connection;

    public function __construct($config)
    {
        $this->connection = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['username'],
            $config['password']
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function executeQuery($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
