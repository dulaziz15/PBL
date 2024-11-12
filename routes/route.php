<?php
require '../vendor/autoload.php';
use Pbl\Controller\AuthController;
use Pbl\Routes\routeBiodata;
use Pbl\Routes\routeMahasiswa;
use Pbl\Routes\routeTA;
use Pbl\Routes\routeUser;

$biodata = new routeBiodata();
$auth = new AuthController();
$user = new RouteUser();
$tugas_akhir = new routeTA();
$mahasiswa = new routeMahasiswa();

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
        } elseif ($page == 'tugasakhir') {
            $tugas_akhir->route();
        } elseif ($page == 'mahasiswa') {
            $mahasiswa->route();
        } elseif($page == 'dashboard') {
            header('location:../view/dashboard/index.php');
        }
    } elseif ($_SESSION['user']['role'] == 2) {
        if ($page == 'biodata') {
            $biodata->route();
        } elseif($page == 'dashboard') {
            header('location:../view/dashboard/index.php');
        }
    } elseif ($_SESSION['user']['role'] == 3) {
        
    } else {
        header('location:../view/403.php');
    }
} else {
    header('location:../view/login.php');
}
