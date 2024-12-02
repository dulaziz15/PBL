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

    public function edit($id) {
        header('location:../view/' . View::TUGASAKHIR->value . '/edit.php?id=' . $id);
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
        $mahasiswa_list = $_POST['mahasiswa'];
        list($mahasiswa, $nim) = explode(':', $mahasiswa_list);
        $targetDir = '../src/bebas_tanggungan/' . $nim . "/";

        @mkdir($targetDir, 0777, true);
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

    public function update($id) {
        $data = $this->tugas_akhir->update($id);
        if($data == true) {
            $_SESSION['sukses'] = "Data Behasil diupdate";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal diupdate Coba Kembali";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }

    public function updateDokumenTA($id) {
        $file = $_FILES['dokumen'];
        $data = $this->tugas_akhir->updateDokumenTA($id, $file);
        $dokumen = $this->tugas_akhir->getNIMbyDokumen($id);
        $targetDir = '../src/bebas_tanggungan/' . $dokumen['nim'] . "/";
        if($data == true) {
            move_uploaded_file($file['dokumen']['tmp_name'], $targetDir . $file['name']);
            $_SESSION['sukses'] = "Data Behasil diupdate";
            header('location:../view/tugas_akhir/show.php?id=' . $dokumen['tugas_akhir_id']);
        } else {
            $_SESSION['error'] = "Data Gagal diupdate Coba Kembali";
            header('location:../view/tugas_akhir/show.php?id=' . $dokumen['tugas_akhir_id']);
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
        $format = new DateTime();
        $tanggal = $format->format('Y-m-d');
        $data = $this->tugas_akhir->addCatatan($id, $user,  $catatan, $tanggal);
        if($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil ditambahkan";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal ditambahkan Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function getCatatanTA($id) {
        $data = $this->tugas_akhir->getCatatanTA($id);
        if($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function verifikasiCatatan($id) {
        $data = $this->tugas_akhir->verifikasiCatatan($id);
        if($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function verifikasiDokumen($id) {
        $catatan = $this->tugas_akhir->validateCatatan($id);
        $ta = $this->tugas_akhir->getOneDokumen($id);
        if($catatan == null) {
            $data = $this->tugas_akhir->verifikasi($id);
            $this->verifikasiTA($ta['tugas_akhir_id']);
            if($data == true) {
                $_SESSION['sukses'] = "Dokumen Behasil terverifikasi";
                header('location:../view/tugas_akhir/show.php?id=' . $ta['tugas_akhir_id']);
            } else {
                $_SESSION['error'] = "Dokumen Gagal terverifikasi Coba Kembali";
                header('location:../view/tugas_akhir/show.php?id=' . $ta['tugas_akhir_id']);
            }
        } else {
            $_SESSION['error'] = "Pastikan Catatan telah terverifikasi !";
            header('location:../view/tugas_akhir/show.php?id=' . $ta['tugas_akhir_id']);
        }
    }

    public function verifikasiTA($id) {
        $data = $this->tugas_akhir->validateTA($id);
        if($data == null) {
            $this->tugas_akhir->updateStatusTA($id);
            return true;
        } else {
            return true;
        }
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