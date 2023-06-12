<?php

class Database
{
    private $connection;

    public function __construct($config)
    {
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset']; // UTF-8-Kodierung hinzugefügt

        $this->connection = new PDO(
            $dsn,
            $config['username'],
            $config['password']
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
