<?php
namespace Pbl\Controller;

use Pbl\Core\Controller;

session_start();    

class BiodataController extends Controller{
    private $user_id;
    public function __construct() {
        $this->user_id = $_SESSION['user']['user_id'];
        parent::__construct();
    }

    public function getOne($id) {
        $data = $this->mahasiswa->getOneByUser($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function managebiodata() {
        header('location:../view/biodata/index.php');
    }

    public function updateBiodata($id) {
        $user = $_POST['user_id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $telp = $_POST['telp'];
        $temp_lahir = $_POST['temp_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        if (empty($img)) {
            $data = $this->mahasiswa->update($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat,  $id);
            if ($data == true) {
                $_SESSION['sukses'] = "data berhasil di Update";
                header('location:../routes/route.php?page=biodata&sub=managebiodata');
            } else {
                $_SESSION['error'] = "data gagal di Update";
                header('location:../routes/route.php?page=biodata&sub=managebiodata');
            }
        } else {
            $path = "../src/img/mahasiswa/";
            $imgNama = $_FILES['img']['tmp_name'];
            $namaImg = $_FILES['img']['name'];
            move_uploaded_file($imgNama, $path . $namaImg);
            $data = $this->mahasiswa->updateImg($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $namaImg, $id);
            if ($data == true) {
                $_SESSION['sukses'] = "data berhasil di Update";
                header('location:../routes/route.php?page=biodata&sub=managebiodata');
            } else {
                $_SESSION['error'] = "data gagal di Update";
                header('location:../routes/route.php?page=biodata&sub=managebiodata');
            }
        }
    }
}