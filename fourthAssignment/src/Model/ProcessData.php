<?php

namespace Model;

interface ProcessData
{
    public function insertData();
    public function getData(array $what, string $from, array $where);
}