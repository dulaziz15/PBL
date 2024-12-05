<?php

namespace Pbl\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Pbl\Enums\status;
use Pbl\Model\BebasTanggungan;
use Pbl\Model\DokumenPendukung;
use Pbl\Model\Mahasiswa;
use Pbl\Model\TugasAkhir;

class BebasTanggunganController
{
    private $bebasTanggungan;
    private $tugasAkhir;
    private $mahasiswa;
    private $dokumenPendukung;

    public function __construct()
    {
        $this->bebasTanggungan = new BebasTanggungan();
        $this->tugasAkhir = new TugasAkhir();
        $this->dokumenPendukung = new DokumenPendukung();
        $this->mahasiswa = new Mahasiswa();
    }

    public function getAll()
    {
        $data = $this->bebasTanggungan->getAll();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOne($id)
    {
        $data = $this->bebasTanggungan->getOne($id);
        return $data;
    }

    public function verifikasi($id)
    {
        $bebasTanggungan = $this->getOne($id);
        if ($bebasTanggungan['status_tugas_akhir'] == status::APPROVED->value) {
            if ($bebasTanggungan['status_dokumen_pendukung'] == status::APPROVED->value) {
                $addSurat = $this->addSurat($bebasTanggungan);
                if ($addSurat) {
                    $this->bebasTanggungan->updateStatus($id);
                    $_SESSION['sukses'] = "Bebas Tanggungan berhasil dibuat !!";
                    header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
                } else {
                    $_SESSION['error'] = "Dokumen Pendukung gagal dibuat, coba lagi !!";
                    header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
                }
            } else {
                $_SESSION['error'] = "Dokumen Pendukung belum terverifikasi !!";
                header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
            }
        } else {
            $_SESSION['error'] = "Dokumen TA belum terverifikasi !!";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        }
    }

    public function add()
    {
        $tugas_akhir_id = $_POST['tugas_akhir'];
        $tugas_akhir = $this->tugasAkhir->getOne($tugas_akhir_id);
        $no_surat = "BebasTanggungan/" . $tugas_akhir['NIM'];
        $data = $this->bebasTanggungan->add($tugas_akhir_id, $no_surat);
        if ($data == true) {
            $_SESSION['sukses'] = "Data Behasil ditambahkan";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        } else {
            $_SESSION['error'] = "Data Gagal ditambahkan Coba Kembali";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        }
    }

    public function getAllVerify()
    {
        $data = $this->tugasAkhir->getAllVerify();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOneMahasiswa($id)
    {
        $mahasiswa = $this->mahasiswa->getOneByUser($id);
        $data = $this->bebasTanggungan->getOneMahasiswa($mahasiswa['mahasiswa_id']);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function hapus($id)
    {
        $data = $this->bebasTanggungan->hapus($id);
        if ($data == true) {
            $_SESSION['sukses'] = "Data Behasil dihapus";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        } else {
            $_SESSION['error'] = "Data Gagal dihapus Coba Kembali";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        }
    }

    public function addSurat($bebasTanggungan)
    {
        try {
            $templatePath = '../view/component/surat.html';
            $htmlContent = file_get_contents($templatePath);

            // Ganti placeholder dengan data dinamis
            $htmlContent = str_replace('{{no_surat}}', $bebasTanggungan['no_surat'], $htmlContent);
            $htmlContent = str_replace('{{nama}}', $bebasTanggungan['nama'], $htmlContent);
            $htmlContent = str_replace('{{nim}}', $bebasTanggungan['NIM'], $htmlContent);

            // Konversi HTML ke PDF
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($htmlContent);

            // Set ukuran kertas dan orientasi
            $dompdf->setPaper('A4', 'portrait');

            // Render PDF
            $dompdf->render();

            // Simpan PDF ke file
            $pdfPath = '../src/surat/bebas_tanggungan_' . $bebasTanggungan['NIM'] . '.pdf';
            file_put_contents($pdfPath, $dompdf->output());

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function dataDashboard()
    {
        $totalMahasiswa = $this->mahasiswa->getAll();
        $totalTA = $this->tugasAkhir->getAll();
        $totalDokumen = $this->dokumenPendukung->getAll();
        $totalBebastanggungan = $this->bebasTanggungan->getAll();
        $bebasTanggunganApproved = count(array_filter($totalBebastanggungan, function($item) {
            return $item['status_bebas_tanggungan'] == 'Approved';
        }));
        $dokumenApproved = count(array_filter($totalDokumen, function($item) {
            return $item['status_dokumen_pendukung'] == 'Approved';
        }));
        $TAApproved = count(array_filter($totalTA, function($item) {
            return $item['status_tugas_akhir'] == 'Approved';
        }));
        $content = [
            'total_mahasiswa' => count($totalMahasiswa),
            'total_ta' => count($totalTA),
            'total_dokumen' => count($totalDokumen),
            'total_bebas_tanggungan' => count($totalBebastanggungan),
            'bebas_tanggungan_approved' => $bebasTanggunganApproved,
            'dokumen_approved' => $dokumenApproved,
            'ta_approved' => $TAApproved
        ];
        header('Content-Type: application/json');
        echo json_encode($content);
    }

    public function donwloadBebasTanggungan($id)
    {
        $data = $this->bebasTanggungan->getOne($id);
        $file = '../src/surat/bebas_tanggungan_' . $data['NIM'] . '.pdf';
        // var_dump($file);
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        } else {
            $_SESSION['error'] = "File Tidak Ditemukan harap hubungi Admin !";
            header('location:../routes/route.php?page=bebastanggungan&sub=manageBebasTanggungan');
        }
    }
}
