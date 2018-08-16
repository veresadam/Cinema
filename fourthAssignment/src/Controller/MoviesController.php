<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 14.08.2018
 * Time: 14:09
 */

namespace Controller;

use Helper\RequestHelper;
use Model\Collections\Collection;
use Model\Repositories\GenreRepository;
use Model\Repositories\MovieRepository;
use View\View;

class MoviesController extends Controller
{
    public function showMoviesAction(int $page)
    {
        $requestHelper = new RequestHelper();

        $date = $requestHelper->getSanitizedParam('date');
        $genre = $requestHelper->getSanitizedParam('genrePicker');
        $yrOfProd = $requestHelper->getSanitizedParam('yrOfProd');

        $movieRepo  = new MovieRepository();
        $moviesCollection = $movieRepo->getMovies($yrOfProd, $genre, $date);
        $moviesToSend = new Collection();
        if ($moviesCollection->getItem((($page - 1) * 5))) {
            for ($i = ($page - 1) * 5; $i < ($page - 1) * 5 + 5; $i++) {
                if ($moviesCollection->getItem($i) !== null) {
                    $moviesToSend->addItem($moviesCollection->getItem($i));
                }
            }
        }
        $genreRepo = new GenreRepository();
        $genresCollection = $genreRepo->getGenres();
        $view = new View('View/moviesTemplate.phtml');
        $view->render(['movies' => $moviesToSend, 'genres' => $genresCollection]);
    }
}