<?php

namespace Model;

class User implements ProcessData
{
    protected $email;
    private $pwd;

    public function __construct($mail, $pwd)
    {
        $this->email = $mail;
        $this->pwd = md5($pwd);
        self::insertData();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function insertData()
    {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $stmt = $pdo->prepare("INSERT INTO user (`email`, `pwd`) VALUES (:email, :pwd)");
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pwd', $this->pwd);
        $stmt->execute();
    }

    public function getData(array $what, string $from, array $where)
    {
        // TODO: Implement getData() method.
    }
}