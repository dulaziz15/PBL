<?php
namespace Pbl\Routes;
use Pbl\Controller\BiodataController;
use Pbl\Core\Route;

class routeBiodata extends Route {
    private $biodata;

    public function __construct() {
        $this->biodata = new BiodataController();
        $this->routes = [
            'getOne' => 'getOne',
            'managebiodata' => 'managebiodata',
            'updateBiodata' => 'updateBiodata'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {
        $sub = isset($_GET['sub']) ? $_GET['sub'] : "";
        $id = $id ?: ($_GET['id'] ?? "");

        parent::route($this->biodata, $sub, $id);
    }
}