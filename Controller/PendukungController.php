<?php
namespace Pbl\Controller;

use DateTime;
use Pbl\Model\DokumenPendukung;

class PendukungController {
    private $DokumenPendukung;

    public function __construct() {
        $this->DokumenPendukung = new DokumenPendukung();
    }

    public function getAll() {
        $data = $this->DokumenPendukung->getAll();
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function add() {
        $file = [
            'tanda_terima_ta' => $_FILES['tanda_terima_ta'],
            'tanda_terima_pkl' => $_FILES['tanda_terima_pkl'],
            'bebas_kompen' => $_FILES['bebas_kompen']
        ];
        $tugas_akhir_data = $_POST['tugas_akhir'];
        list($tugas_akhir, $nim) = explode(':', $tugas_akhir_data);
        $targetDir = '../src/dokumen_pendukung/' . $nim . "/";

        @mkdir($targetDir, 0777, true);
        $data = $this->DokumenPendukung->add($tugas_akhir, $file);
        if($data) {
            foreach($file as $dokumen) {
                move_uploaded_file($dokumen['tmp_name'], $targetDir . $dokumen['name']);
            }
            $_SESSION['sukses'] = "Data Behasil ditambah";
            header('location:../routes/route.php?page=dokumenpendukung&sub=manageDokumen');
        } else {
            $_SESSION['error'] = "Data Gagal ditambah Coba Kembali";
            header('location:../routes/route.php?page=dokumenpendukung&sub=manageDokumen');
        }
    }

    public function getOne($id) {
        $data = $this->DokumenPendukung->getOne($id);
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
        $format = new DateTime();
        $tanggal = $format->format('Y-m-d');
        $data = $this->DokumenPendukung->addCatatan($id, $user, $catatan, $tanggal);
        if($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil ditambahkan";
            header('location:../view/dokumen/show.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal ditambahkan Coba Kembali";
            header('location:../view/dokumen/show.php?id=' . $id);
        }
    }

    public function getCatatan($id) {
        $data = $this->DokumenPendukung->getCatatan($id);
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function verifikasiCatatan($id) {
        $data = $this->DokumenPendukung->verifikasiCatatan($id);
        if($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/dokumen/show.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/dokumen/show.php?id=' . $id);
        }
    }

    public function hapus($id) {
        $data = $this->DokumenPendukung->hapus($id);
        if($data == true) {
            $_SESSION['sukses'] = "Data Behasil dihapus";
            header('location:../routes/route.php?page=dokumenpendukung&sub=manageDokumen');
        } else {
            $_SESSION['error'] = "Data Gagal dihapus Coba Kembali";
            header('location:../routes/route.php?page=dokumenpendukung&sub=manageDokumen');
        }
    }
}