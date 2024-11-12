<?php
namespace Pbl\Controller;
use Pbl\Model\Mahasiswa;
session_start();    

class BiodataController {
    private $mahasiswa;
    private $user_id;
    public function __construct() {
        $this->mahasiswa = new Mahasiswa();
        $this->user_id = $_SESSION['user']['user_id'];
    }

    public function getOne() {
        $data = $this->mahasiswa->getOne($this->user_id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function managebiodata() {
        header('location:../view/biodata/index.php');
    }
}