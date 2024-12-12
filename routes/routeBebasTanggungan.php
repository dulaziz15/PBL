<?php
namespace Pbl\Routes;

use Pbl\Controller\BebasTanggunganController;
use Pbl\Core\Route;

class routeBebasTanggungan extends Route {
    private $bebasTanggungan;

    public function __construct() {
        $this->bebasTanggungan = new BebasTanggunganController();
        $this->routes = [
            'manageBebasTanggungan' => 'index',
            'getAll' => 'getAll',
            'verifikasi' => 'verifikasi',
            'add' => 'add',
            'getAllVerify' => 'getAllVerify',
            'downloadBebasTanggungan' => 'downloadBebasTanggungan',
            'dataDashboard' => 'dataDashboard',
            'hapus' => 'delete',
            'getOneMahasiswa' => 'getOneMahasiswa'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {  
        $sub = $sub ?: ($_GET['sub'] ?? 'manageBebasTanggungan');
        $id = $id ?: ($_GET['id'] ?? "");

        parent::route($this->bebasTanggungan, $sub, $id);
    }
}
?>