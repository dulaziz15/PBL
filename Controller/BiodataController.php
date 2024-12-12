<?php
namespace Pbl\Controller;

use Pbl\Core\Controller;

session_start();    

class BiodataController extends Controller{
    private $user_id;
    public function __construct() {
        $this->user_id = $_SESSION['user']['user_id'];
        parent::__construct();
    }

    public function getOne($id) {
        $data = $this->mahasiswa->getOneByUser($id);
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