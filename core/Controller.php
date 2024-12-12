<?php
namespace Pbl\Core;

use Pbl\Model\BebasTanggungan;
use Pbl\Model\DokumenPendukung;
use Pbl\Model\Mahasiswa;
use Pbl\Model\TugasAkhir;
use Pbl\Model\User;
use Pbl\View\View;

class Controller {
    protected $user;
    protected $mahasiswa;
    protected $DokumenPendukung;
    protected $tugas_akhir;
    protected $bebasTanggungan; 

    public function __construct() {
        $this->user = new User();
        $this->mahasiswa = new Mahasiswa();
        $this->DokumenPendukung = new DokumenPendukung();
        $this->tugas_akhir = new TugasAkhir();
        $this->bebasTanggungan = new BebasTanggungan();
    }
}