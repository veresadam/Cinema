<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 16.08.2018
 * Time: 21:04
 */

namespace Controller;

use Model\Repositories\MovieRepository;
use Model\Repositories\Repository;
use Model\Connection;
use View\View;

class ReservationController
{
    public function chooseScreeningAction(int $id)
    {
        $movieRepo  = new MovieRepository();
        $movies = $movieRepo->getMovies();
        $movie = $movies->getItem($id);

        $screeningRepo  = new Repository();
        $screenings = $screeningRepo->getAll('screening');

        $conn = new Connection();
        $pdo = $conn->getConnection();
        $query = $pdo->prepare("SELECT date FROM screening WHERE movie_id = {$movie->getId()}");
        $query->execute();
        $screeningDate = $query->fetchAll(\PDO::FETCH_ASSOC);

        $view = new View('View/reservationTemplate.phtml');
        $view->render(['movie' => $movie]);
    }
}