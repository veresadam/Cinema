<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 18:32
 */

namespace Model\Repositories;
use Model\Connection as Connection;



class Repository
{
    protected $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConnection();
    }

    public function getAll($table)
    {
        $dbContentsQuery = $this->pdo->prepare("SELECT * FROM $table");
        $dbContentsQuery->execute();
        return $dbContentsQuery->fetchAll(\PDO::FETCH_ASSOC);
    }
}