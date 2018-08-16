<?php
require '../../vendor/autoload.php';
use Model\Entities\User as User;

    if (isset($_POST['register-submit'])) {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
            if ($_POST['password'] === $_POST['confirm-password']) {
                $user = new User($_POST['email'], $_POST['password']);
                session_start();
                $_SESSION['user'] = $user->getEmail();
            } else {
                header("Location: cinema.local/");
            }
        }
    }