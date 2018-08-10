<?php
require_once "../../../vendor/autoload.php";

use Model\Admin\Admin as Admin;

function adminFunction(){
    $input = getopt('', ['importGenres:', 'importFilms:', 'roomSetup:', 'setScreening:']);

    if (isset($input['importGenres'])) {
        Admin::createGenreTable($input['importGenres']);
    }
    if (isset($input['importFilms'])) {
        Admin::createMoviesTable($input['importFilms']);
    }
    if (isset($input['roomSetup'])) {
        Admin::setupRooms($input['roomSetup']);
    }
    if (isset($input['setScreening'])) {
        Admin::setScreening($input['setScreening']);
    }
    echo "exit\n";
}

adminFunction();