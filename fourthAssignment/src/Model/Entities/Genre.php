<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 19:41
 */

namespace Model\Entities;


class Genre extends Entity
{
    protected $genre;

    public function __construct(int $id, string $genre)
    {
        $this->id = $id;
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

}