<?php
require '../vendor/autoload.php';
require_once './routeUser.php';
use Pbl\Controller\AuthController;

$auth = new AuthController();
$user = new RouteUser();

$page = isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 'login';

if ($page == 'login') {
    $auth->login();
} elseif ($page == 'proses_login') {
    $auth->proses_login();
} elseif ($page == 'logout') {
    $auth->logout();
}

if (isset($_SESSION['user'])) {
    if($_SESSION['user']['role'] == 1) {
        if ($page == 'user') {
            $user->route();
        }
    } elseif ($_SESSION['user']['role'] == 2) {
        header('location:../view/dashboard/index.php');
    } else {
        header('location:../view/403.php');
    }
} else {
    header('location:../view/login.php');
}
