<?php
namespace Pbl\Routes;

use Pbl\Controller\PendukungController;

class routePendukung {
    private $DokumenPendukung;

    public function __construct() {
        $this->DokumenPendukung = new PendukungController();
    }

    public function route() {
        $sub = isset($_GET['sub']) ? $_GET['sub'] : $_GET['sub'] = 'manageDokumen';
        $id = isset($_GET['id']) ? $_GET['id'] : "";

        if($sub == "manageDokumen") {
            // var_dump("cek");
            header('location:../view/dokumen/index.php');
        } elseif($sub == "getAll") {
            $this->DokumenPendukung->getAll();
        } elseif($sub == "addDokumen") {
            $this->DokumenPendukung->add();
        } elseif($sub == "getOne") {
            $this->DokumenPendukung->getOne($id);
        } elseif($sub == "getOneByTugasAkhir") {
            $this->DokumenPendukung->getOneByTugasAkhir($id);
        } elseif($sub == "updateDokumen") {
            $this->DokumenPendukung->updateDokumen($id);
        } elseif($sub == "tambahcatatan") {
            $this->DokumenPendukung->addCatatan($id); 
        } elseif($sub == "getCatatan") {
            $this->DokumenPendukung->getCatatan($id);
        } elseif($sub == "getOneCatatan") {
            $this->DokumenPendukung->getOneCatatan($id);
        } elseif($sub == "updateCatatan") {
            $this->DokumenPendukung->updateCatatan($id);
        } elseif($sub == 'pengajuanCatatan') {
            $this->DokumenPendukung->pengajuanCatatan($id);
        }elseif($sub == 'verifikasiCatatan') {
            $this->DokumenPendukung->verifikasiCatatan($id);
        } elseif($sub == 'hapusCatatan') {
            $this->DokumenPendukung->hapusCatatan($id);
        } elseif($sub == 'verifikasiDokumen') {
            $this->DokumenPendukung->verifikasiDokumen($id);
        } elseif($sub == "hapus") {
            $this->DokumenPendukung->hapus($id);
        } 

        // role mahasiswa
        elseif($sub == 'getOneMahasiswa') {
            $this->DokumenPendukung->getOneMahasiswa($id);
        } 
    }
}