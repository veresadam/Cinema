<?php

function createGenreArray($genreArray) {
    $conn = new \Model\Connection();
    $pdo = $conn->getConnection();
    foreach ($genreArray as $genre) {
        $stmt = $pdo->prepare("INSERT INTO  (`genre`) VALUES ($genre)");
        $stmt->execute();
    }
}
