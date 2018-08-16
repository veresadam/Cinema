<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 19:38
 */

namespace Model\Repositories;

use Model\Collections\Collection;
use Model\Entities\Genre;

class GenreRepository extends Repository
{
    public function getGenres()
    {
        $genreData = $this->getAll('genre');

        $collection = new Collection();
        foreach ($genreData as $result) {
            $genre = new Genre($result['id'], $result['genre']);
            $collection->addItem($genre);
        }
        return $collection;
    }
}