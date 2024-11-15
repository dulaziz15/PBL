<?php
namespace Pbl\Routes;
use Pbl\Controller\MahasiswaController;
use Pbl\Controller\UserController;

class routeMahasiswa {
    private $mahasiswa;
    private $user;

    public function __construct() {
        $this->mahasiswa = new MahasiswaController();
        $this->user = new UserController();
    }

    public function route() {
        $sub = isset($_GET['sub']) ? $_GET['sub'] : $_GET['sub'] = 'manageuser';
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if($sub == "managemahasiswa") {
            header('location:../view/mahasiswa/index.php');
        } elseif($sub == "getAll") {
            $this->mahasiswa->getAll();
        } elseif($sub == "show") {
            $this->mahasiswa->show($id);
        } elseif($sub == "getUser") {
            $this->user->getEmpty();
        } elseif($sub == "addMahasiswa") {
            $this->mahasiswa->addMahasiswa();
        } elseif($sub == "edit") {
            $this->mahasiswa->edit($id);
        } elseif($sub == 'getWithUser') {
            $this->mahasiswa->getOne($id);
        } elseif($sub == 'updateMahasiswa') {
            $this->mahasiswa->update($id);
        } elseif($sub == 'hapus') {
            $this->mahasiswa->hapus($id);
        }
    }
}