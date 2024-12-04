<?php
namespace Pbl\Model;
use Pbl\Config\Koneksi;
use Pbl\Enums\status;
use PDOException;

class BebasTanggungan {
    private $koneksi;

    public function __construct() {
        $this->koneksi = new Koneksi();
    }

    public function getAll() {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data-> fetchAll();
        return $result;
    }

    public function getOne($id) {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id inner join Dokumen_pendukung as dok on dok.tugas_akhir_id = ta.tugas_akhir_id WHERE bebas_tanggungan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function updateStatus($id) {
        try {
            $query = "UPDATE Bebas_tanggungan SET status_bebas_tanggungan = '" . status::APPROVED->value . "' WHERE bebas_tanggungan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
}