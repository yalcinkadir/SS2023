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

}
