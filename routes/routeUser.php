<?php
    use Dulaz\Controller\UserController;
    class RouteUser {
        private $user;
        public function __construct(){
            $this->user = new UserController();
        }

        public function route() {  
            $sub = isset($_GET['sub']) ? $_GET['sub'] : $_GET['sub'] = 'manageuser';
            $id = isset($_GET['id']) ? $_GET['id'] : "";
            if($sub == 'manageuser') {
                header('location:../view/user/index.php');
            } elseif ($sub == 'tambahuser') {
                $this->user->addUser();
            } elseif ($sub == 'getAll') {
                $this->user->getAll();
            } elseif($sub == 'edit') {
                $this->user->edit($id);
            } elseif($sub == 'getOne') {
                $this->user->getOne($id);
            } elseif($sub == 'update') {
                $this->user->update($id);
            } elseif($sub == 'hapus') {
                $this->user->delete($id);
            }
        }
    }
?>