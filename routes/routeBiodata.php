<?php
namespace Pbl\Routes;
use Pbl\Controller\BiodataController;

class routeBiodata {
    private $biodata;

    public function __construct() {
        $this->biodata = new BiodataController();
    }

    public function route() {
        $sub = isset($_GET['sub']) ? $_GET['sub'] : "";
        if($sub == 'getone') {
            $this->biodata->getOne();
        } elseif($sub == 'managebiodata') {
            $this->biodata->managebiodata();
        }
    }
}