<?php
require '../vendor/autoload.php';

use Pbl\Controller\AuthController;
use Pbl\Enums\role;
use Pbl\Routes\routeArsip;
use Pbl\Routes\routeBebasTanggungan;
use Pbl\Routes\routeBiodata;
use Pbl\Routes\routeMahasiswa;
use Pbl\Routes\routePendukung;
use Pbl\Routes\routeTA;
use Pbl\Routes\routeUser;

// Inisialisasi controller
$controllers = [
    'auth' => new AuthController(),
    'user' => new routeUser(),
    'tugasakhir' => new routeTA(),
    'mahasiswa' => new routeMahasiswa(),
    'dokumenpendukung' => new routePendukung(),
    'bebastanggungan' => new routeBebasTanggungan(),
    'biodata' => new routeBiodata(),
    'arsip' => new routeArsip()
];

// Default page
$page = $_GET['page'] ?? 'login';

if ($page === 'login') {
    $controllers['auth']->login();
    exit;
} elseif ($page === 'proses_login') {
    $controllers['auth']->proses_login();
    exit;
} elseif ($page === 'logout') {
    $controllers['auth']->logout();
    exit;
} elseif ($page === 'dashboard') {
    header('location:../view/dashboard/index.php');
    exit;
}

if (!isset($_SESSION['user'])) {
    header('location:../view/login.php');
    exit;
}

$roleRoutes = [
    role::SUPER_ADMIN->value => ['user', 'tugasakhir', 'dokumenpendukung', 'bebastanggungan', 'mahasiswa', 'dashboard', 'arsip'],
    role::MAHSISWA->value => ['biodata', 'tugasakhir', 'mahasiswa', 'dokumenpendukung', 'bebastanggungan', 'dashboard'],
    role::ADMIN_JURUSAN->value => ['tugasakhir', 'mahasiswa', 'bebastanggungan', 'dashboard', 'arsip'],
    role::ADMIN_PRODI->value => ['dokumenpendukung', 'mahasiswa', 'bebastanggungan', 'dashboard', 'arsip'],
];

$userRole = $_SESSION['user']['role'];
if (!isset($roleRoutes[$userRole]) || !in_array($page, $roleRoutes[$userRole])) {
    header('location:../view/403.php');
    exit;
}

if (isset($controllers[$page])) {
    $controllers[$page]->route();
} else {
    header('location:../view/404.php');
}