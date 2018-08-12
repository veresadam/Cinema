<?php
namespace Model\Admin;

use Model\Connection as Connection;

class Importer
{
    private $reader;
    private $pdo;

    public function __construct(Connection $conn, Reader $reader)
    {
        $this->pdo = $conn->getConnection();
        $this->reader = $reader;
    }

    public function importGenre($genresFile) {

        $genreArray = $this->reader->readFile($genresFile);
        $valueString = [];
        foreach ($genreArray as $row) {
            $valueString[] = '('.$this->pdo->quote($row['id']).','.$this->pdo->quote($row['genre']).')';
        }
        $stmt = $this->pdo->prepare("INSERT INTO  genre (`genre`) VALUES (".implode(',',$valueString).")");
        $stmt->execute();
    }

    public function importMovies($moviesFile) {

        $movieArray = $this->reader->readFile($moviesFile);
        $valueString = [];
        foreach ($movieArray as $movie) {
            $valueString[] = '('.$this->pdo->quote($movie['id']).','.$this->pdo->quote($movie['title']).','.$this->pdo->quote($movie['date_of_production'])
                .','.$this->pdo->quote($movie['image']).')';
            self::createMovie_GenreTable($movie['genres'], $movie['id']);
        }
        $stmt = $this->pdo->prepare("INSERT INTO  movie (`id`, `title`, `date_of_production`, `image`) VALUES (".implode(',', $valueString).")");
        $stmt->execute();


    }

    private function createMovie_GenreTable($movieGenreString, $movieId) {

        $movieGenres = explode('|', $movieGenreString);
        $valueString = [];
        foreach ($movieGenres as $genre) {
            $stmt = $this->pdo->prepare("SELECT `id` FROM `Genre` WHERE `genre`= {$this->pdo->quote($genre)}");
            $stmt->execute();
            $genreId = $stmt->fetch();
            $valueString[] = '('.$this->pdo->quote($movieId).','.$this->pdo->quote($genreId).')';
        }
        $stmt = $this->pdo->prepare("INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES (".implode(',',$valueString).")");
        $stmt->execute();
    }

    public function importRooms($roomsFile) {

        $roomsArray = $this->reader->readFile($roomsFile);
        $valueString = [];
        foreach ($roomsArray as $roomData) {
            $valueString[] = '('.$this->pdo->quote($roomData['id']).','.$this->pdo->quote($roomData['name']).','.$this->pdo->quote($roomData['rows'])
                .','.$this->pdo->quote($roomData['seats_per_row']);
        }
        $stmt = $this->pdo->prepare("INSERT INTO  room (`id`, `name`, `rows`, `seats_per_row`) VALUES (".implode(',', $valueString).")");
        $stmt->execute();
    }

    public function setScreening($data) {
        $data = explode(' ', $data);
        $date = implode(" ", [$data[0],$data[1]]);
        $stmt = $this->pdo->prepare("SELECT * FROM room WHERE id = {$this->pdo->quote($data[3])}");
        $stmt->execute();
        $roomData = $stmt->fetch();
        $rows = count(explode('|', $roomData['rows']));
        $seats = $rows * $roomData['seats_per_row'];
        $stmt = $this->pdo->prepare("INSERT INTO screening (`date`, `movie_id`, `room_id`, `seats`) VALUES 
            ({$this->pdo->quote($date)},{$this->pdo->quote($data[2])},{$this->pdo->quote($data[3])},{$this->pdo->quote($seats)})");
        $stmt->execute();

    }



}