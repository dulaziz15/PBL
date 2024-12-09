<?php
namespace Pbl\Controller;
use Pbl\Model\Mahasiswa;
use Pbl\Model\User;
use Pbl\Interface\UserControllerInterface;


class UserController implements UserControllerInterface {
    private $user;
    private $mahasiswa;

    public function __construct() {
        $this->user = new User();
        $this->mahasiswa = new Mahasiswa();
    }

    public function addUser(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $data = $this->user->addUser($username, $email, $password, $role);
        if($data == true) {
            $_SESSION['sukses'] = "Data Berhasil Ditambahkan";
            header('location:../routes/route.php?page=user&sub=manageuser');
        } else {
            $_SESSION['error'] = "Gagal menambahkan data! Pastikan Username dan Email belum digunakan!!";
            header('location:../routes/route.php?page=user&sub=manageuser');
        }
    }

    public function getAll() {
        $data = $this->user->getAll();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(false);
        }
    }

    public function getEmpty() {
        $data = $this->user->getEmpty();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(false);
        }
    }

    public function edit($id) {
        header('location:../view/user/update.php?id=' . $id);
    }

    public function getOne($id) {
        $data = $this->user->getOne($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function update($id) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $data = $this->user->update($id, $username, $email, $password, $role);
        if($data == true) {
            $_SESSION['sukses'] = "Data Berhasil Diupdate";
            header('location:../routes/route.php?page=user&sub=manageuser');
        } else {
            $_SESSION['error'] = "Data Gagal Diupdate Coba ulang kembali";
            header('location:../routes/route.php?page=user&sub=manageuser');
        }
    }

    public function delete($id) {
        $data = $this->user->delete($id);
        if($data == true) {
            $_SESSION['sukses'] = "Data Behasil dihapus";
            header('location:../routes/route.php?page=user&sub=manageuser');
        } else {
            $_SESSION['error'] = "Data Gagal dihapus Coba Kembali";
            header('location:../routes/route.php?page=user&sub=manageuser');
        }
    }
}