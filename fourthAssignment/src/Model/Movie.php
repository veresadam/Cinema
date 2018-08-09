<?php

class Movie
{
    protected $id;
    protected $title;
    protected $yearOfProduction;
    protected $genres;
    protected $image;

    public function __construct($id, $title, $year, $genres, $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->yearOfProduction = $year;
        $this->image = $img;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }
}