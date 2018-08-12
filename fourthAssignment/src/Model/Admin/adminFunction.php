<?php

namespace Model\Admin;

use Model\Connection as Connection;


function adminFunction(){
    $input = getopt('', ['importGenres:', 'importFilms:', 'importRoom:', 'importScreening:']);

    try {
        $conn = new Connection();
        $reader = new Reader();
        $importer = new Importer($conn, $reader);

        if (isset($input['importGenres'])) {
            $importer->importGenre($input['importGenres']);
        }
        if (isset($input['importFilms'])) {
            $importer->importMovies($input['importFilms']);
        }
        if (isset($input['importRoom'])) {
            $importer->importRooms($input['roomSetup']);
        }
        if (isset($input['importScreening'])) {
            $importer->setScreening($input['importScreening']);
        }
        echo "Admin commands executed properly! :D" . PHP_EOL;
    } catch (\Exception $exception) {
        echo "Something went wrong: {$exception->getMessage()}";
    }

}

adminFunction();