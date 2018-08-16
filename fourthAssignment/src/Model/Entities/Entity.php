<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 19:54
 */

namespace Model\Entities;


class Entity
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}