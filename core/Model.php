<?php
namespace Pbl\Core;
use Pbl\Config\Koneksi;

class Model {
    protected $koneksi;

    public function __construct() {
        $this->koneksi = new Koneksi();
    }
}