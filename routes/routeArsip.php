<?php
namespace Pbl\Routes;

use Pbl\Controller\ArsipController;
use Pbl\Core\Route;

class routeArsip extends Route {
    private $arsip;
    public function __construct() {
        $this->arsip = new ArsipController();
        $this->routes = [
            'manageArsip' => 'index',
            'getAllVerify' => 'getAllVerify',
            'getOne' => 'getOne'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {
        $sub = $sub ?: ($_GET['sub'] ?? 'manageArsip');
        $id = $id ?: ($_GET['id'] ?? "");

        parent::route($this->arsip, $sub, $id);
    }
}