<?php
require '../vendor/autoload.php';
use Pbl\Controller\AuthController;
use Pbl\Enums\role;
use Pbl\Routes\routeBebasTanggungan;
use Pbl\Routes\routeBiodata;
use Pbl\Routes\routeMahasiswa;
use Pbl\Routes\routePendukung;
use Pbl\Routes\routeTA;
use Pbl\Routes\routeUser;

$biodata = new routeBiodata();
$auth = new AuthController();
$user = new RouteUser();
$tugas_akhir = new routeTA();
$mahasiswa = new routeMahasiswa();
$pendukung = new routePendukung();
$bebasTanggungan = new routeBebasTanggungan();

$page = isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 'login';

if ($page == 'login') {
    $auth->login();
} elseif ($page == 'proses_login') {
    $auth->proses_login();
} elseif ($page == 'logout') {
    $auth->logout();
}

if (isset($_SESSION['user'])) {
    if($_SESSION['user']['role'] == role::SUPER_ADMIN->value) {
        if ($page == 'user') {
            $user->route();
        } elseif ($page == 'tugasakhir') {
            $tugas_akhir->route();
        } elseif ($page == 'dokumenpendukung') {
            $pendukung->route();
        } elseif ($page == 'bebastanggungan') {
            $bebasTanggungan->route();
        } elseif ($page == 'mahasiswa') {
            $mahasiswa->route();
        } elseif($page == 'dashboard') {
            header('location:../view/dashboard/index.php');
        }
    } elseif ($_SESSION['user']['role'] == role::MAHSISWA->value) {
        if ($page == 'biodata') {
            $biodata->route();
        } elseif ($page == 'tugasakhir') {
            $tugas_akhir->route();
        } elseif ($page == 'mahasiswa') {
            $mahasiswa->route();
        } elseif ($page == 'dokumenpendukung') {
            $pendukung->route();
        } elseif ($page == 'bebastanggungan') {
            $bebasTanggungan->route();
        } elseif($page == 'dashboard') {
            header('location:../view/dashboard/index.php');
        }
    } elseif ($_SESSION['user']['role'] == role::ADMIN_JURUSAN->value) {
        
    } else {
        header('location:../view/403.php');
    }
} else {
    header('location:../view/login.php');
}
