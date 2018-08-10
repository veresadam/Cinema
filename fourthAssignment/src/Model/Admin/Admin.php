<?php
namespace Model\Admin;

use Model\Connection as Connection;

class Admin
{
    //TODO INSERT INTO `product` (`id`,`name`, `price`)
    //TODO VALUES (10000, 'PHP programmer', 5000)
    //TODO ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `price` = VALUES(`price`); #VALUES(name) means you are using the value in the insert statement
    private static function importFromFile($File) {
        $fileArray = file($File, FILE_IGNORE_NEW_LINES);
        $resultArray = [];
        foreach ($fileArray as $row) {
            $resultArray[] = explode(',', $row);
        }
        return $resultArray;
    }


    public static function createGenreTable($genresFile) {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $genreArray = self::importFromFile($genresFile);
        foreach ($genreArray[0] as $genre) {
            $stmt = $pdo->prepare("INSERT INTO  Genre (`genre`) VALUES ({$pdo->quote($genre)})");
            $stmt->execute();
        }
    }

    public static function createMoviesTable($moviesFile) {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $movieArray = self::importFromFile($moviesFile);

        foreach ($movieArray as $movie) {
            $movie[0] = $pdo->quote($movie[0]);
            $movie[1] = $pdo->quote($movie[1]);
            $movie[2] = $pdo->quote($movie[2]);
            $movie[3] = $pdo->quote($movie[3]);
            $stmt = $pdo->prepare("INSERT INTO  Movie (`id`, `title`, `date_of_production`, `image`) VALUES (".implode(',', [$movie[0],$movie[1],$movie[2],$movie[3]]).")");
            $stmt->execute();
            $movieGenres = explode('|', $movie[4]);
            foreach ($movieGenres as $genre) {
                $stmt = $pdo->prepare("SELECT `id` FROM `Genre` WHERE `genre`= {$pdo->quote($genre)}");
                $stmt->execute();
                $genreId = $stmt->fetch();
                $stmt = $pdo->prepare("INSERT INTO `Movie_Genre` (`movie_id`, `genre_id`) VALUES ($movie[0], {$pdo->quote($genreId['id'])})");
                $stmt->execute();
            }
        }
    }

    public static function setupRooms($roomsFile) {
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $roomsArray = self::importFromFile($roomsFile);
        foreach ($roomsArray as $roomData) {
            $roomData[0] = $pdo->quote($roomData[0]);
            $roomData[1] = $pdo->quote($roomData[1]);
            $roomData[2] = $pdo->quote($roomData[2]);
            $roomData[3] = $pdo->quote($roomData[3]);
            $stmt = $pdo->prepare("INSERT INTO  room (`id`, `name`, `rows`, `seats_per_row`) VALUES (".implode(',', [$roomData[0],$roomData[1],$roomData[2],$roomData[3]]).")");
            $stmt->execute();
        }
    }

    public static function setScreening($data) {
        $data = explode(' ', $data);
        $date = implode(" ", [$data[0],$data[1]]);
        $conn = new Connection();
        $pdo = $conn->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM room WHERE id = {$pdo->quote($data[3])}");
        $stmt->execute();
        $roomData = $stmt->fetch();
        $rows = count(explode('|', $roomData['rows']));
        $seats = $rows * $roomData['seats_per_row'];
//        echo "INSERT INTO screening (`date`, `movie_id`, `room_id`, `seats`) VALUES ({$pdo->quote($date)},{$pdo->quote($data[2])},{$pdo->quote($data[3])},{$pdo->quote($seats)})";
        $stmt = $pdo->prepare("INSERT INTO screening (`date`, `movie_id`, `room_id`, `seats`) VALUES ({$pdo->quote($date)},{$pdo->quote($data[2])},{$pdo->quote($data[3])},{$pdo->quote($seats)})");
        $stmt->execute();

    }



}