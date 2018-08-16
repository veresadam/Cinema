<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 18:25
 */

namespace Model\Repositories;


class ScreeningRepository extends Repository
{
    public function getScreeningsFromDatabase()
    {
        {
            $collection = new MovieCollection();
            $dbContentsQuery = $this->pdo->prepare("SELECT * FROM movie");
            $dbContentsQuery->execute();
            $movieData = $dbContentsQuery->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($movieData as $result) {
                $movie = new Movie($result['id'], $result['title'], $result['date_of_production'], $result['image']);
                $collection->addMovie($movie);
            }
            return $collection;
        }
    }
}