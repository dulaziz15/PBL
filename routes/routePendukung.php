<?php
namespace Pbl\Routes;

use Pbl\Controller\PendukungController;
use Pbl\Core\Route;

class routePendukung extends Route{
    private $DokumenPendukung;

    public function __construct() {
        $this->DokumenPendukung = new PendukungController();
        $this->routes = [
            'manageDokumen' => 'index',
            'getAll' => 'getAll',
            'addDokumen' => 'add',
            'getOne' => 'getOne',
            'getOneByTugasAkhir' => 'getOneByTugasAkhir',
            'updateDokumen' => 'update',
            'tambahcatatan' => 'addCatatan',
            'getCatatan' => 'getCatatan',
            'getOneCatatan' => 'getOneCatatan',
            'updateCatatan' => 'updateCatatan',
            'pengajuanCatatan' => 'pengajuanCatatan',
            'verifikasiCatatan' => 'verifikasiCatatan',
            'hapusCatatan' => 'hapusCatatan',
            'verifikasiDokumen' => 'verifikasiDokumen',
            'hapus' => 'delete',
            'getOneMahasiswa' => 'getOneMahasiswa'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {
        $sub = $sub ?: ($_GET['sub'] ?? 'manageUser');
        $id = $id ?: ($_GET['id'] ?? "");
        
        parent::route($this->DokumenPendukung, $sub, $id);
    }
}