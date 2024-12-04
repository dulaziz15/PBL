<?php

namespace Pbl\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use mPDF;
use Pbl\Enums\status;
use Pbl\Model\BebasTanggungan;
use Pbl\Model\DokumenPendukung;
use Pbl\Model\TugasAkhir;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\HTML;

class BebasTanggunganController
{
    private $bebasTanggungan;
    private $tugasAkhir;
    private $dokumenPendukung;

    public function __construct()
    {
        $this->bebasTanggungan = new BebasTanggungan();
        $this->tugasAkhir = new TugasAkhir();
        $this->dokumenPendukung = new DokumenPendukung();
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
}
