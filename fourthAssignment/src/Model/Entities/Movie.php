<?php

namespace Model\Entities;

use Model\Connection as Connection;

class Movie extends Entity
{
    protected $title;
    protected $yearOfProduction;
    protected $genres = [];
    protected $image;

    public function __construct(int $id, string $title, int $year, string $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->yearOfProduction = $year;
        $this->image = $image;
        self::setGenres();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
    }

    public function setGenres()
    {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $stmt = $pdo->prepare("SELECT `genre` FROM `genre` WHERE `id` IN (SELECT `genre_id` FROM movie_genre WHERE `movie_id` = {$this->id})");
        $stmt->execute();
        while ($genre = $stmt->fetch()) {
            $this->genres[] = ucfirst($genre['genre']);
        }
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }
}