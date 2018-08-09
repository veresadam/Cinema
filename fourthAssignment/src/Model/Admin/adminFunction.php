<?php
require_once "../../../vendor/autoload.php";

use Model\Admin\Admin as Admin;

function adminFunction(){
    $input = getopt('', ['importGenres:', 'importFilms:', 'roomSetup:']);

    if (isset($input['importGenres'])) {
        Admin::createGenreTable($input['importGenres']);
    }
    if (isset($input['importFilms'])) {
        Admin::createMoviesTable($input['importFilms']);
    }
    if (isset($input['roomSetup'])) {
        Admin::setupRooms($input['roomSetup']);
    }
    echo "exit\n";
}

adminFunction();