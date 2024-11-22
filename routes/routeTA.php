<?php
namespace Pbl\Routes;
use Pbl\Controller\TugasAkhirController;

class routeTA {
    private $tugas_akhir;

    public function __construct() {
        $this->tugas_akhir = new TugasAkhirController();
    }

    public function route() {
        $sub = isset($_GET['sub']) ? $_GET['sub'] : $_GET['sub'] = 'manageuser';
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if($sub == 'manageTA') {
            $this->tugas_akhir->index();
        } elseif($sub == 'getAll') {
            $this->tugas_akhir->getAll();
        } elseif($sub == 'getOne') {
            $this->tugas_akhir->getOne($id);
        } elseif($sub == 'add') {
            $this->tugas_akhir->add();
        } elseif($sub == 'getByTugasAkhir') {
            $this->tugas_akhir->getByTA($id);
        } elseif($sub == 'getOneDokumen') {
            $this->tugas_akhir->getOneDokumen($id);
        } elseif($sub == 'hapus') {
            $this->tugas_akhir->hapus($id);
        } 
        
    }
}