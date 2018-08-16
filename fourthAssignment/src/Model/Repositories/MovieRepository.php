<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 14.08.2018
 * Time: 17:15
 */

namespace Model\Repositories;

use Model\Entities\Movie;
use Model\Collections\Collection;

class MovieRepository extends Repository
{
    public function getMovies(string $yearOfProduction = null, string $genre = null, string $dateOfScreening = null)
    {
        $collection = new Collection();
        $dateQuery = '';
        $yearQuery = '';
        $genreQuery = '';
        $dateData = [];

        if ($yearOfProduction !== null) {
            $yearQuery = " `id` IN (SELECT `id` FROM `movie` WHERE `date_of_production` = :yearOfProd)";
            $yearOfProduction = (int)$yearOfProduction;
            $implodeQuery[] = $yearQuery;
        }

        if ($genre !== null) {
            $genreQuery = " `id` IN (SELECT `movie_id` AS `id` FROM movie_genre WHERE `genre_id` = :genre)";
            $implodeQuery[] = $genreQuery;
        }

        if ($dateOfScreening !== null) {
            $dateData = explode('-', $dateOfScreening);
            $dateQuery = " `id` IN (SELECT `movie_id` FROM `screening` WHERE DAY(`date`) = :day AND MONTH(`date`) = :month AND YEAR(`date`) = :year)";
        } else {
            $dateQuery = " `id` IN (SELECT `movie_id` FROM `screening` WHERE `date`>NOW())";
        }

        $implodeQuery[] = $dateQuery;
        $stmt = $this->pdo->prepare("SELECT * FROM movie WHERE" . implode(' AND ', $implodeQuery));;
        if ($dateOfScreening !== null) {
            $stmt->bindValue('day', $dateData[2]);
            $stmt->bindValue('month', $dateData[1]);
            $stmt->bindValue('year', $dateData[0]);
        }

        if ($yearQuery !== '') {
            $stmt->bindValue('yearOfProd', $yearOfProduction);
        }

        if ($genreQuery !== '') {
            $stmt->bindValue('genre', $genre, \PDO::PARAM_STR);
        }

        $stmt->execute();
        $filteredMovies = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($filteredMovies as $movieData) {
            $movie = new Movie($movieData['id'], $movieData['title'], $movieData['date_of_production'], $movieData['image']);
            $collection->addItem($movie);
        }

        return $collection;
    }
}