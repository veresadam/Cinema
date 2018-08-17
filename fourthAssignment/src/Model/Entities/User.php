<?php

namespace Model\Entities;

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

    public function getPwd()
    {
        return $this->pwd;
    }

}