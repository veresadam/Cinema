<?php
require '../../vendor/autoload.php';
use Model\User as User;


    if (isset($_POST['mail'], $_POST['pwd'], $_POST['conf'])) {
        if ($_POST['pwd'] === $_POST['conf']) {
            $user = new User($_POST['mail'], $_POST['pwd']);
        } else {
            header("Location: cinema.local/");
        }
    }