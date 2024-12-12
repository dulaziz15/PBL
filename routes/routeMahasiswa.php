<?php
namespace Pbl\Routes;
use Pbl\Controller\MahasiswaController;
use Pbl\Controller\UserController;
use Pbl\Core\Route;
use Pbl\Enums\view;

class routeMahasiswa extends Route{
    private $mahasiswa;

    public function __construct() {
        $this->mahasiswa = new MahasiswaController();
        $this->routes = [
            'managemahasiswa' => 'index',
            'getAll' => 'getAll',
            'show' => 'show',
            'addMahasiswa' => 'add',
            'edit' => 'edit',
            'getWithUser' => 'getOne',
            'getByUser' => 'getByUser',
            'updateMahasiswa' => 'update',
            'hapus' => 'delete'
        ];
    }

    public function route($controller = null, $sub = '', $id = '') {
        $sub = $sub ?: ($_GET['sub'] ?? 'manageUser');
        $id = $id ?: ($_GET['id'] ?? "");
        
        parent::route($this->mahasiswa, $sub, $id);
    }
}