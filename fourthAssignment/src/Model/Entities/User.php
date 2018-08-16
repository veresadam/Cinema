<?php

namespace Model\Entities;

use Model\Connection as Connection;

class User
{
    protected $email;
    private $pwd;

    public function __construct(string $mail, string $pwd)
    {
        $this->email = $mail;
        $this->pwd = md5($pwd);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    protected function getPwd()
    {
        return $this->pwd;
    }

}