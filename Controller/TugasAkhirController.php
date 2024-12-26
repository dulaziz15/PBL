<?php

namespace Pbl\Controller;

use DateTime;
use Exception;
use Jurosh\PDFMerge\PDFMerger;
use Karriere\PdfMerge\PdfMerge;
use Pbl\Core\Controller;
use Pbl\Enums\view;
use Pbl\Interface\ManagementDataInterface;

class TugasAkhirController extends Controller implements ManagementDataInterface
{

    public function index()
    {
        header('location:../view/' . View::TUGASAKHIR->value);
    }

    public function getAll()
    {
        $data = $this->tugas_akhir->getAll();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOne($id)
    {
        $data = $this->tugas_akhir->getOne($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function edit($id)
    {
        header('location:../view/' . View::TUGASAKHIR->value . '/edit.php?id=' . $id);
    }

    public function add()
    {
        // Menentukan ukuran maksimum file 
        $maxFileSize = 2 * 1024 * 1024; // 2MB dalam byte

        // Daftar file yang diupload
        $file = [
            'pendahuluan' => $_FILES['pendahuluan'],
            'abstrak' => $_FILES['abstrak'],
            'isi' => $_FILES['isi'],
            'daftarpustaka' => $_FILES['daftarpustaka'],
            'lampiran' => $_FILES['lampiran']
        ];

        // Ambil input lainnya
        $judul = $_POST['judul'];
        $mahasiswa_list = $_POST['mahasiswa'];
        list($mahasiswa, $nim) = explode(':', $mahasiswa_list);
        $targetDir = '../src/bebas_tanggungan/' . $nim . "/";

        // Buat direktori tujuan 
        @mkdir($targetDir, 0777, true);

        // Validasi ukuran file
        foreach ($file as $key => $dokumen) {
            if ($dokumen['size'] > $maxFileSize) {
                $_SESSION['error'] = "File " . $dokumen['name'] . " terlalu besar. Maksimum ukuran file adalah 2MB.";
                header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
                exit();
            }
        }

        // Jika validasi berhasil, lanjutkan untuk menambah data
        $data = $this->tugas_akhir->add($file, $mahasiswa, $judul);

        if ($data == true) {
            foreach ($file as $dokumen) {
                // Pindahkan file yang valid ke direktori tujuan
                move_uploaded_file($dokumen['tmp_name'], $targetDir . $dokumen['name']);
            }
            $_SESSION['sukses'] = "Data Berhasil ditambah";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal ditambah. Coba Kembali.";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }


    public function update($id)
    {
        $data = $this->tugas_akhir->update($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Data Behasil diupdate";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal diupdate Coba Kembali";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }

    public function updateDokumenTA($id)
    {
        $file = $_FILES['dokumen'];
        $data = $this->tugas_akhir->updateDokumenTA($id, $file);
        $dokumen = $this->tugas_akhir->getNIMbyDokumen($id);
        $targetDir = '../src/bebas_tanggungan/' . $dokumen['nim'] . "/";
        if ($data == true) {
            move_uploaded_file($file['dokumen']['tmp_name'], $targetDir . $file['name']);
            $_SESSION['sukses'] = "Data Behasil diupdate";
            header('location:../view/tugas_akhir/show.php?id=' . $dokumen['tugas_akhir_id']);
        } else {
            $_SESSION['error'] = "Data Gagal diupdate Coba Kembali";
            header('location:../view/tugas_akhir/show.php?id=' . $dokumen['tugas_akhir_id']);
        }
    }

    public function getByTA($id)
    {
        $data = $this->tugas_akhir->getDokumen($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOneCatatan($id)
    {
        $data = $this->tugas_akhir->getOneCatatan($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOneDokumen($id)
    {
        $data = $this->tugas_akhir->getOneDokumen($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function addCatatan($id)
    {
        $user = $_SESSION['user']['user_id'];
        $catatan = $_POST['catatan'];
        $format = new DateTime();
        $tanggal = $format->format('Y-m-d');
        $data = $this->tugas_akhir->addCatatan($id, $user,  $catatan, $tanggal);
        if ($data == true) {
            $this->tugas_akhir->rejectedTA($id);
            $_SESSION['sukses'] = "Catatan Behasil ditambahkan";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal ditambahkan Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function getCatatanTA($id)
    {
        $data = $this->tugas_akhir->getCatatanTA($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function updateCatatan($id)
    {
        $catatan = $_POST['catatan'];
        $data = $this->tugas_akhir->updateCatatan($id, $catatan);
        if ($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function verifikasiCatatan($id)
    {
        $data = $this->tugas_akhir->verifikasiCatatan($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function pengajuanCatatan($id)
    {
        $data = $this->tugas_akhir->pengajuanCatatan($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function hapusCatatan($id)
    {
        $data = $this->tugas_akhir->hapusCatatan($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Catatan Behasil terverifikasi";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        } else {
            $_SESSION['error'] = "Catatan Gagal terverifikasi Coba Kembali";
            header('location:../view/tugas_akhir/show_dokumen.php?id=' . $id);
        }
    }

    public function verifikasiDokumen($id)
    {
        $rejected = $this->tugas_akhir->validateCatatan($id);
        $ta = $this->tugas_akhir->getOneDokumen($id);
        if ($rejected == null) {
            $data = $this->tugas_akhir->verifikasi($id);
            $this->verifikasiTA($ta['tugas_akhir_id']);
            if ($data == true) {
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

    private function verifikasiTA($id)
    {
        $pending = $this->tugas_akhir->validateCatatanPending($id);
        if ($pending != null) {
            $data = $this->tugas_akhir->changePending($id);
        }

        $data = $this->tugas_akhir->validateTA($id);
        if ($data == null) {
            $this->tugas_akhir->updateStatusTA($id);
            $this->mergePDF($id);
            return true;
        } else {
            return true;
        }
    }

    private function mergePDF($id)
    {
        $data = $this->tugas_akhir->getDokumen($id);
        $mahasiswa = $this->tugas_akhir->getOne($id);

        $folderPath = realpath('../src/bebas_tanggungan/' . $mahasiswa['NIM']);

        if (!$folderPath) {
            echo "Directory does not exist: " . $folderPath;
            return;
        }

        if (!is_writable($folderPath)) {
            echo "Directory is not writable: " . $folderPath;
            return;
        }

        $outputFile = $folderPath . DIRECTORY_SEPARATOR . $mahasiswa['NIM'] . '.pdf';

        echo "Output file path: " . $outputFile . "<br>";

        $pdf = new PdfMerge();

        foreach ($data as $file) {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file['nama_file'];

            if (file_exists($filePath)) {
                $pdf->add($filePath);
            } else {
                echo "File not found: " . $filePath . "<br>";
            }
        }

        try {
            $pdf->merge($outputFile, 'F');  // 'F' is for saving to a file
            echo "PDF berhasil digabungkan menjadi: " . $outputFile;
        } catch (Exception $e) {
            echo "Error merging PDFs: " . $e->getMessage();
        }
    }


    public function delete($id)
    {
        $data = $this->tugas_akhir->hapus($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Data Behasil dihapus";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        } else {
            $_SESSION['error'] = "Data Gagal dihapus Coba Kembali";
            header('location:../routes/route.php?page=tugasakhir&sub=manageTA');
        }
    }

    public function getOneMahasiswa($id)
    {
        $mahasiswa = $this->mahasiswa->getOneByUser($id);
        $data = $this->tugas_akhir->getOneMahasiswa($mahasiswa['mahasiswa_id']);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getTAMahasiswa($id)
    {
        $data = $this->tugas_akhir->getTAMahasiswa($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }
}
