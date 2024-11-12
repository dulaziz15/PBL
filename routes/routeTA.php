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
        }
    }
}