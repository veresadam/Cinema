<?php
require_once "../../../vendor/autoload.php";

use Model\Admin\Reader as Reader;
use Model\Connection as Connection;
use Model\Admin\Importer as Importer;


function adminFunction(){
    $input = getopt('', ['importGenres:', 'importMovies:', 'importRooms:', 'importScreening:']);

    try {
        $conn = new Connection();
        $reader = new Reader();
        $importer = new Importer($conn, $reader);

        if (isset($input['importGenres'])) {
            $importer->importGenre($input['importGenres']);
        }
        if (isset($input['importMovies'])) {
            $importer->importMovies($input['importMovies']);
        }
        if (isset($input['importRooms'])) {
            $importer->importRooms($input['importRooms']);
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