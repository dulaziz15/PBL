<?php
namespace Pbl\Routes;

use Pbl\Controller\BebasTanggunganController;
use Pbl\Controller\UserController;
use Pbl\Core\Route;

class routeUser extends Route {
    private $user;

    public function __construct() {
        $this->user = new UserController();
        $this->routes = [
            'manageuser' => 'index',
            'tambahuser' => 'add',
            'edit' => 'edit',
            'getAll' => 'getAll',
            'getOne' => 'getOne',
            'update' => 'update',
            'hapus' => 'delete',
            'getUser' => 'getEmpty'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {  
        $sub = $sub ?: ($_GET['sub'] ?? 'manageUser');
        $id = $id ?: ($_GET['id'] ?? "");

        parent::route($this->user, $sub, $id);
    }
}
?>