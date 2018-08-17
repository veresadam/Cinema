<?php
require '../../vendor/autoload.php';

use Model\Entities\User as User;
use Model\Repositories\Repository;
$repo = new Repository();
$users = $repo->getAll('user');
foreach ($users as $user) {
    if ($user['email'] === $_POST['email'] && $user['pwd'] === md5($_POST['password'])) {
        $user = new User($_POST['email'], $_POST['password']);
        session_start();
        $_SESSION['user'] = $user->getEmail();
    }
}


if (isset($_SESSION['user'])) {
    echo "login successful";
} else {
    echo "Something must've happened...";
}