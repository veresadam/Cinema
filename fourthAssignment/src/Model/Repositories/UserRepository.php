<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 13.08.2018
 * Time: 12:21
 */

namespace Model\Repositories;

use Model\Entities\User;
use Model\Connection as Connection;

class UserRepository extends User
{
    public function insertData()
    {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $stmt = $pdo->prepare("INSERT INTO user (`email`, `pwd`) VALUES (:email, :pwd)");
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pwd', $this->getPwd());
        $stmt->execute();
    }

    public function getData(array $what, string $from, array $where)
    {

    }
}