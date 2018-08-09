<?php

class Screening
{
    protected $id;
    protected $date;
    protected $hour;
    protected $movie;

    public function __construct($id, $date, $hour, $movie, $theatre)
    {
        $this->id = $id;
        $this->date = $date;
        $this->hour = $hour;
        $this->movie = $movie;
        $this->theatreName = $theatre;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @return mixed
     */
    public function getMovie()
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