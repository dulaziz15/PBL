<?php
namespace Pbl\Routes;
use Pbl\Controller\TugasAkhirController;
use Pbl\Core\Route;

class routeTA extends Route{
    private $tugas_akhir;

    public function __construct() {
        $this->tugas_akhir = new TugasAkhirController();
        $this->routes = [
            'manageTA' => 'index',
            'getAll' => 'getAll',
            'getOne' => 'getOne',
            'edit' => 'edit',
            'add' => 'add',
            'update' => 'update',
            'updateDokumenTA' => 'updateDokumenTA',
            'getByTugasAkhir' => 'getByTA',
            'getOneCatatan' => 'getOneCatatan',
            'getOneDokumen' => 'getOneDokumen',
            'tambahcatatan' => 'addCatatan',
            'getCatatanTA' => 'getCatatanTA',
            'updateCatatan' => 'updateCatatan',
            'verifikasiCatatan' => 'verifikasiCatatan',
            'pengajuanCatatan' => 'pengajuanCatatan',
            'hapusCatatan' => 'hapusCatatan',
            'verifikasi' => 'verifikasiDokumen',
            'hapus' => 'delete',
            'getOneMahasiswa' => 'getOneMahasiswa',
            'getTAMahasiswa' => 'getTAMahasiswa'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {
        $sub = $sub ?: ($_GET['sub'] ?? 'manageUser');
        $id = $id ?: ($_GET['id'] ?? "");

        parent::route($this->tugas_akhir, $sub, $id);
    }
}