<?php

namespace Model;

class Connection
{
    private $connection;
    private $dsn = 'mysql:dbname=Cinema';
    private $user = 'adamveres';
    private $password = '';

    public function __construct()
    {
        $this->connection = new \PDO($this->dsn, $this->user, $this->password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->connection;
    }
}