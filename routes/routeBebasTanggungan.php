<?php
    namespace Pbl\Routes;
    use Pbl\Controller\BebasTanggunganController;
    use Pbl\Enums\view;
    class routeBebasTanggungan {
        private $bebasTanggungan;
        public function __construct(){
            $this->bebasTanggungan = new BebasTanggunganController();
        }

        public function route() {  
            $sub = isset($_GET['sub']) ? $_GET['sub'] : $_GET['sub'] = 'manageuser';
            $id = isset($_GET['id']) ? $_GET['id'] : "";
            if($sub == 'manageBebasTanggungan') {
                header('location:../view/' . view::BEBASTANGGUNGAN->value . '/index.php');
            } elseif($sub == "getAll") {
                $this->bebasTanggungan->getAll();
            } elseif($sub == "verifikasi") {
                $this->bebasTanggungan->verifikasi($id);
            }
        }
    }
?>