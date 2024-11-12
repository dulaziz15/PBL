<?php
namespace Pbl\Model;
use Pbl\Config\koneksi;

class Mahasiswa {
    private $koneksi;
    public function __construct() {
        $this->koneksi = new koneksi();
    }

    public function getOne($id) {
        $query = "SELECT * FROM Mahasiswa WHERE user_id = $id";  
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getAll() {
        $query = "SELECT * FROM Mahasiswa";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function addMahasiswa($nama, $nim, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $img, $user) {
        return true;
    }
}