<?php
require '../../vendor/autoload.php';

use Model\Connection as Connection;

    if (isset($_POST['register-submit'])) {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
            if ($_POST['password'] === $_POST['confirm-password']) {
                $conn = new Connection();
                $pdo = $conn->getConnection();
                $insert = $pdo->prepare("INSERT INTO user (`email`, `pwd`) VALUES ({$pdo->quote($_POST['email'])},{$pdo->quote($_POST['password'])})");
                $insert->execute();
                echo "Registration has been completed!";
            } else {
                header("Location: cinema.local/");
            }
        }
    }