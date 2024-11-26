<?php
namespace Pbl\Controller;

use DateTime;
use Pbl\Model\Mahasiswa;
use Pbl\Model\TugasAkhir;
use Pbl\Enums\view;

class TugasAkhirController {
    private $tugas_akhir;
    private $mahasiswa;
    private $user;

    public function __construct() {
        $this->tugas_akhir = new TugasAkhir();
        $this->mahasiswa = new Mahasiswa();
        $this->user = $_SESSION['user']['user_id'];
    }

    public function index() {
        header('location:../view/' . View::TUGASAKHIR->value . '/index.php');
    }

    public function getAll() {
        $data = $this->tugas_akhir->getAll();
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOne($id) {
        $data = $this->tugas_akhir->getOne($id);
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }
    
    public function add() {
        $file = [
            'pendahuluan' => $_FILES['pendahuluan'],
            'abstrak' => $_FILES['abstrak'],
            'isi' => $_FILES['isi'],
            'daftarpustaka' => $_FILES['daftarpustaka'],
            'lampiran' => $_FILES['lampiran']
        ];
        $judul= $_POST['judul'];
        $status = 0;
        $mahasiswa = $_POST['mahasiswa'];
        $targetDir = '../src/bebas_tanggungan/' . $mahasiswa . "/";

        @mkdir($targetDir, 0777, true);
        $path = '../src/bebas_tanggungan/' . $_SESSION['user']['username'] . "/";
        $data = $this->tugas_akhir->add($file, $mahasiswa, $judul, $status);
        if($data == true) {
            foreach($file as $dokumen) {
                move_uploaded_file($dokumen['tmp_name'], $targetDir . $dokumen['name']);
            }
            $_SESSION['sukses'] = "Data Behasil ditambah";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal ditambah Coba Kembali";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }

    public function getByTA($id) {
        $data = $this->tugas_akhir->getDokumen($id);
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOneDokumen($id) {
        $data = $this->tugas_akhir->getOneDokumen($id);
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function addCatatan($id) {
        $user = $_SESSION['user']['user_id'];
        $catatan = $_POST['catatan'];
        $tanggal = new DateTime();
        $data = $this->tugas_akhir->addCatatan($id, $user,  $catatan, $tanggal);
    }

    public function hapus($id) {
        $data = $this->tugas_akhir->hapus($id);
        if($data == true) {
            $_SESSION['sukses'] = "Data Behasil dihapus";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal dihapus Coba Kembali";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }
}