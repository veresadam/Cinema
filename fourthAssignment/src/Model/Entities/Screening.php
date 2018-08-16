<?php

namespace Model\Entities;

class Screening extends Entity
{
    protected $dateTime;
    protected $hour;
    protected $movie;

    public function __construct($id, $dateTime,Movie $movie, $theatre)
    {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->movie = $movie;
        $this->theatreName = $theatre;
    }


//    set

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return mixed
     */
    public function getMovieData()
    {
        return $this->movie;
    }

    /**
     * @return mixed
     */
    public function getTheatreName()
    {
        return $this->theatreName;
    }

    /**
     * @return mixed
     */
    public function getAvailableSeats()
    {
        return $this->taken_seats;
    }
}