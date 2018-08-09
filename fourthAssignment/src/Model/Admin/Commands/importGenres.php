<?php

/**
 * Reads the file's contents (which is supposed to be one line with comma
 * genre names separated), and creates an array of genres
 * @param $genresFile
 * @return array
 */
function importGenres($genresFile) {
    $genreArray = file($genresFile, FILE_IGNORE_NEW_LINES);
    $genreArray = explode(',', $genreArray);
    createGenreTable($genreArray);

    return $genreArray;
}
