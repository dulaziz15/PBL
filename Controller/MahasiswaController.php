<?php
namespace Pbl\Controller;
use Pbl\Model\Mahasiswa;

class MahasiswaController {
    private $mahasiswa;
    public function __construct() {
        $this->mahasiswa = new Mahasiswa();
    }

    public function getAll() {
        $data = $this->mahasiswa->getAll();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function show($id) {
        $data = $this->mahasiswa->getOne($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function addMahasiswa() {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $kelas = $_POST['kelas'];
        $telp = $_POST['telp'];
        $temp_lahir = $_POST['temp_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $img = $_FILES['img'];
        $user = $_POST['user_id'];
        $data = $this->mahasiswa->addMahasiswa($nama, $nim, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $img, $user);
    }
}