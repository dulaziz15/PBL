<?php
namespace Pbl\Controller;
use Pbl\Core\Controller;

class ArsipController extends Controller {
    public function index() {
        header('location:../view/arsip/');
    }

    public function getAllVerify() {
        $data = $this->bebasTanggungan->getAllVerify();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getOne($id) {
        $data = $this->tugas_akhir->getOne($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }
}